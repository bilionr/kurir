<?php

namespace Tests\Feature;

use App\Models\Kurir;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KurirTest extends TestCase
{
    public function test_tambah()
    {
        $faker = Faker::create('id_ID');
        $payload = [
            'nama' => 'Budi Agung',
            'no_telp' => $faker->phoneNumber,
            'plat_kendaraan' => strtoupper($faker->bothify('? #### ??')),
            'level' => 3
        ];

        dump("--- STEP 1: Mengirim payload ke API --- \n", $payload);

        $response = $this->postJson('kurirs', $payload);

        dump('--- STEP 2: Response dari server ---');
        $response->dump();

        $response->assertStatus(201);
        dump('--- STEP 3: Status 201 Created (Passed) ---');
        
        // Memastikan data tersimpan di database
        $this->assertDatabaseHas('kurirs', [
            'nama' => 'Budi Agung',
            'level' => 3
        ]);
        dump('--- STEP 4: Data terverifikasi ada di Database (Passed) ---');
    }

    public function test_update()
    {
        // 1. Cari kurir bernama "Budi Agung" di database
        $kurir = \App\Models\Kurir::where('nama', 'Budi Agung')->first();

        // Pastikan datanya ada. Jika tidak ada, hentikan test dan berikan pesan error.
        $this->assertNotNull($kurir, "Data Budi Agung tidak ditemukan! Pastikan test_tambah_kurir dijalankan terlebih dahulu.");

        // 2. Kirim request untuk mengupdate datanya
        $response = $this->putJson("/kurirs/{$kurir->id}", [
            'nama' => 'Billy Update',
            'level' => 5
        ]);

        $response->assertStatus(200);

        // 3. Memastikan data telah berubah di database
        $this->assertDatabaseHas('kurirs', [
            'id' => $kurir->id,
            'nama' => 'Billy Update',
            'level' => 5
        ]);
        
        // Memastikan nama lama sudah tidak ada
        $this->assertDatabaseMissing('kurirs', [
            'id' => $kurir->id,
            'nama' => 'Budi Agung',
        ]);
    }

    public function test_hapus()
    {
        // 1. Cari data kurir yang ingin dihapus (misal: "Billy Update" hasil dari test sebelumnya)
        $kurir = \App\Models\Kurir::where('nama', 'Billy Update')->first();

        // Pastikan datanya ada. Jika tidak ada, hentikan test.
        $this->assertNotNull($kurir, "Data Billy Update tidak ditemukan! Pastikan test_update_kurir dijalankan terlebih dahulu.");

        // 2. Kirim request DELETE ke API
        $response = $this->deleteJson("/kurirs/{$kurir->id}");

        // 3. Verifikasi response status 204 (No Content / Berhasil dihapus)
        $response->assertStatus(204);

        // 4. Memastikan data benar-benar hilang dari database
        $this->assertDatabaseMissing('kurirs', [
            'id' => $kurir->id,
            'nama' => 'Billy Update'
        ]);
    }
}