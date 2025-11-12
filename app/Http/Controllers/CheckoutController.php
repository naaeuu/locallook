<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserAddress;
use App\Models\Order; // <-- IMPORT
use App\Models\OrderItem; // <-- IMPORT
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config; // <-- IMPORT
use Midtrans\Snap; // <-- IMPORT

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans saat controller diinisiasi
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Menampilkan halaman form pilih/tambah alamat.
     */
    public function addressForm()
    {
        $addresses = Auth::user()->addresses()->latest()->get();
        return view('checkout.address', [
            'addresses' => $addresses
        ]);
    }

    /**
     * Menyimpan alamat baru dari form.
     */
    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);
        $validated['user_id'] = Auth::id();
        UserAddress::create($validated);

        return redirect()->route('checkout.address')
            ->with('success', 'Alamat baru berhasil disimpan!');
    }


    /**
     * BARU: Membuat Order, Item, dan mendapatkan Snap Token.
     * (Menggantikan processCheckout)
     */
    public function createPayment(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'cart' => 'required|json',
            'address_id' => 'required|integer|exists:user_addresses,id',
        ]);

        $address = UserAddress::find($request->input('address_id'));
        if ($address->user_id !== Auth::id()) {
            return response()->json(['error' => 'Alamat tidak valid.'], 403);
        }

        $cartData = json_decode($request->input('cart'), true);
        if (empty($cartData)) {
            return response()->json(['error' => 'Keranjang Anda kosong.'], 400);
        }

        // 2. Inisialisasi total dan item Midtrans
        $totalAmount = 0;
        $midtransItems = [];

        DB::beginTransaction();
        try {
            // 3. Buat Invoice Number Unik
            $invoiceNumber = 'LOKALOOK-' . time() . '-' . Auth::id();

            // 4. Buat Order (Draft)
            $order = Order::create([
                'user_id' => Auth::id(),
                'user_address_id' => $address->id,
                'invoice_number' => $invoiceNumber,
                'total_amount' => 0, // Akan di-update nanti
                'status' => 'unpaid',
            ]);

            // 5. Loop keranjang untuk validasi stok & hitung total
            foreach ($cartData as $item) {
                $product = Product::find($item['id']);
                if ($product->stock < $item['jumlah']) {
                    throw new \Exception("Stok produk '{$item['name']}' tidak mencukupi.");
                }

                $itemPrice = $product->price * $item['jumlah'];
                $totalAmount += $itemPrice;

                // 6. Buat Order Items
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['jumlah'],
                    'price' => $product->price,
                ]);

                // 7. Siapkan item untuk Midtrans
                $midtransItems[] = [
                    'id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $item['jumlah'],
                    'name' => $product->name
                ];
            }

            // 8. Update total amount di order
            $order->update(['total_amount' => $totalAmount]);

            // 9. Siapkan data untuk Midtrans
            $user = Auth::user();
            $params = [
                'transaction_details' => [
                    'order_id' => $invoiceNumber, // Gunakan invoice kita
                    'gross_amount' => $totalAmount,
                ],
                'item_details' => $midtransItems,
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $address->phone_number,
                    'billing_address' => [
                        'first_name' => $address->recipient_name,
                        'phone' => $address->phone_number,
                        'address' => $address->address_line_1,
                        'city' => $address->city,
                        'postal_code' => $address->postal_code,
                    ]
                ],
            ];

            // 10. Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);

            // 11. Simpan Snap Token ke order & commit
            $order->update(['snap_token' => $snapToken]);
            DB::commit();

            // 12. Kembalikan Snap Token ke Frontend
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
