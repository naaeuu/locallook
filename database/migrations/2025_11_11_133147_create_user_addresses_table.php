<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();

            // Kolom untuk menghubungkan ke tabel 'users'
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Kolom untuk info alamat
            $table->string('label'); // Contoh: "Rumah", "Kantor", "Apartemen"
            $table->string('recipient_name'); // Nama Penerima
            $table->string('phone_number');   // No. HP Penerima
            $table->text('address_line_1'); // Alamat Lengkap (Jalan, No, RT/RW)
            $table->string('city');           // Kota/Kabupaten
            $table->string('postal_code', 10); // Kode Pos

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
