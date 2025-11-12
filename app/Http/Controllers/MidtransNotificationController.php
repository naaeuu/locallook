<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransNotificationController extends Controller
{
    /**
     * Handle notifikasi (webhook) dari Midtrans.
     */
    public function handle(Request $request)
    {
        // 1. Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        // 2. Buat instance notifikasi Midtrans
        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;
        $fraudStatus = $notif->fraud_status;

        // 3. Cari Order di database kita berdasarkan Invoice Number
        $order = Order::where('invoice_number', $orderId)->first();

        // 4. Proses Verifikasi Keamanan Sederhana
        if (!$order) {
            return response()->json(['error' => 'Order not found.'], 404);
        }

        // 5. Logika Utama Pengurangan Stok
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            if ($fraudStatus == 'accept') {

                // Cek jika order sudah 'paid', jangan proses lagi
                if ($order->status == 'paid') {
                    return response()->json(['message' => 'Order already processed.']);
                }

                // --------- DI SINILAH KITA MENGURANGI STOK ---------
                try {
                    DB::beginTransaction();

                    // Update status order menjadi 'paid'
                    $order->update(['status' => 'paid']);

                    // Loop semua item di order ini
                    foreach ($order->items as $item) {
                        $product = Product::find($item->product_id);
                        if ($product) {
                            // Kurangi stok
                            $product->stock -= $item->quantity;
                            $product->save();
                        }
                    }

                    DB::commit();
                    return response()->json(['message' => 'Payment success, stock updated.']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['error' => 'Failed to update stock.'], 500);
                }
                // --------------------------------------------------

            }
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            // Jika pembayaran dibatalkan atau kadaluwarsa
            $order->update(['status' => 'cancelled']);
            return response()->json(['message' => 'Payment cancelled/expired.']);
        } else if ($transactionStatus == 'pending') {
            // Jika pembayaran masih pending
            $order->update(['status' => 'unpaid']);
            return response()->json(['message' => 'Payment pending.']);
        }

        return response()->json(['message' => 'Notification processed.']);
    }
}
