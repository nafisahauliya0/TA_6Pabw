<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\PetugasSeeder;
use Database\Seeders\LaporanSeeder;

class LaporBanjirAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Jalankan seeder agar data awal (admin BPBD dan laporan dummy) tersedia untuk pengujian
        $this->seed(PetugasSeeder::class);
        $this->seed(LaporanSeeder::class);
    }

    /**
     * Test 1: Warga dapat membuka form pelaporan tanpa harus login (Status 200).
     */
    public function test_warga_dapat_mengakses_form_pelaporan_tanpa_login(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Formulir Pelaporan Banjir');
        $response->assertSee('Nama Pelapor');
        $response->assertSee('Login Petugas');
    }

    /**
     * Test 2: Warga dapat mengirim laporan banjir dan melihat konfirmasi dengan x-alert.
     */
    public function test_warga_dapat_mengirim_laporan_dan_melihat_konfirmasi(): void
    {
        $payload = [
            'nama_pelapor'     => 'Asep Suhendar',
            'lokasi'           => 'Baleendah',
            'tinggi_genangan'  => 65,
            'tanggal_kejadian' => now()->format('Y-m-d'),
        ];

        $response = $this->post('/simpan', $payload);
        $response->assertStatus(200);
        $response->assertSee('Konfirmasi Laporan Berhasil');
        $response->assertSee('Sukses:');
        $response->assertSee('Asep Suhendar');
        $response->assertSee('Baleendah');
        $response->assertSee('Siaga');

        $this->assertDatabaseHas('laporan', [
            'nama_pelapor' => 'Asep Suhendar',
            'lokasi'       => 'Baleendah',
        ]);
    }

    /**
     * Test 3: Pengunjung yang belum login diblokir dari /daftar-laporan dan diredirect ke /login.
     */
    public function test_unauthenticated_user_diarahkan_ke_login_saat_buka_daftar_laporan(): void
    {
        $response = $this->get('/daftar-laporan');
        $response->assertRedirect('/login');
    }

    /**
     * Test 4: Registrasi akun petugas baru secara manual.
     */
    public function test_registrasi_petugas_baru_berhasil_dan_langsung_login(): void
    {
        $email = 'petugas.baru' . rand(1000, 9999) . '@bandungkab.go.id';
        $response = $this->post('/register', [
            'name'                  => 'Petugas Lapangan Baru',
            'email'                 => $email,
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('lapor.daftar'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => $email]);
    }

    /**
     * Test 5: Login gagal jika password salah.
     */
    public function test_login_gagal_jika_password_salah(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email'    => 'admin.bpbd@bandungkab.go.id',
            'password' => 'passwordsalah',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test 6: Login berhasil menggunakan akun admin BPBD hasil seeder.
     */
    public function test_login_berhasil_menggunakan_akun_admin_bpbd(): void
    {
        $response = $this->post('/login', [
            'email'    => 'admin.bpbd@bandungkab.go.id',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('lapor.daftar'));
        $this->assertAuthenticated();
    }

    /**
     * Test 7: Petugas yang sudah login dapat membuka /daftar-laporan dan melihat menu petugas.
     */
    public function test_petugas_login_dapat_melihat_daftar_laporan_dan_navigasi_khusus(): void
    {
        $user = User::where('email', 'admin.bpbd@bandungkab.go.id')->first();

        $response = $this->actingAs($user)->get('/daftar-laporan');
        $response->assertStatus(200);
        $response->assertSee('Daftar Laporan Kejadian Banjir');
        $response->assertSee('Profil Petugas');
        $response->assertSee('Logout');
    }

    /**
     * Test 8: Petugas yang sudah login dapat membuka halaman profil.
     */
    public function test_petugas_dapat_melihat_halaman_profil(): void
    {
        $user = User::where('email', 'admin.bpbd@bandungkab.go.id')->first();

        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
        $response->assertSee('Profil Petugas BPBD Kabupaten Bandung');
    }

    /**
     * Test 9: Logout menghapus session dan mengarahkan kembali ke halaman utama.
     */
    public function test_petugas_dapat_logout(): void
    {
        $user = User::where('email', 'admin.bpbd@bandungkab.go.id')->first();

        $response = $this->actingAs($user)->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
