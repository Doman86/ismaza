<?php

namespace Tests\Feature;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_login_bisa_diakses(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_ismaza_login_dengan_username_saja(): void
    {
        $this->seed();

        $response = $this->post('/login/ismaza', ['username' => 'ismaza']);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs(
            \App\Models\User::where('role', 'user')->first()
        );
    }

    public function test_ismaza_login_case_insensitive(): void
    {
        $this->seed();

        foreach (['ISMAZA', 'Ismaza', 'ismaza'] as $username) {
            $this->post('/login/ismaza', ['username' => $username]);
            $this->assertAuthenticated();
            $this->post('/logout');
        }
    }

    public function test_username_salah_ditolak(): void
    {
        $this->seed();

        $response = $this->post('/login/ismaza', ['username' => 'bukanismaza']);

        $response->assertSessionHasErrors('username');
        $this->assertGuest();
    }

    public function test_admin_login_dengan_email_dan_password(): void
    {
        $this->seed();

        $response = $this->post('/login/admin', [
            'email'    => 'admin@example.com',
            'password' => 'Admin123!',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs(
            \App\Models\User::where('role', 'admin')->first()
        );
    }

    public function test_ismaza_tidak_bisa_membuka_area_admin(): void
    {
        $this->seed();

        $ismaza = \App\Models\User::where('role', 'user')->first();

        $response = $this->actingAs($ismaza)->get('/admin/dashboard');

        $response->assertRedirect(route('home'));
    }

    public function test_admin_tidak_bisa_membuka_halaman_user(): void
    {
        $this->seed();

        $admin = \App\Models\User::where('role', 'admin')->first();

        $response = $this->actingAs($admin)->get('/home');

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_bisa_upload_foto(): void
    {
        Storage::fake('public');
        $this->seed();

        $admin = \App\Models\User::where('role', 'admin')->first();

        $response = $this->actingAs($admin)->post(route('admin.photos.store'), [
            'title'       => 'Foto Uji',
            'description' => 'Deskripsi uji',
            'image'       => UploadedFile::fake()->image('foto.jpg', 600, 400),
        ]);

        $response->assertRedirect(route('admin.photos.index'));
        $this->assertDatabaseHas('photos', ['title' => 'Foto Uji']);
        Storage::disk('public')->assertExists('photos');
    }

    public function test_upload_ditolak_jika_bukan_gambar(): void
    {
        $this->seed();

        $admin = \App\Models\User::where('role', 'admin')->first();

        $response = $this->actingAs($admin)->post(route('admin.photos.store'), [
            'title' => 'Foto Uji',
            'image' => UploadedFile::fake()->create('dokumen.pdf', 100),
        ]);

        $response->assertSessionHasErrors('image');
        $this->assertDatabaseCount('photos', 0);
    }

    public function test_hapus_foto_juga_menghapus_file_fisik(): void
    {
        $this->seed();

        $admin = \App\Models\User::where('role', 'admin')->first();

        $photo = Photo::create([
            'title'       => 'Foto Hapus',
            'description' => null,
            'image_path'  => 'photos/hapus-test.jpg',
        ]);

        // Buat file dummy di storage
        Storage::disk('public')->put('photos/hapus-test.jpg', 'dummy');

        $response = $this->actingAs($admin)->delete(route('admin.photos.destroy', $photo));

        $response->assertRedirect(route('admin.photos.index'));
        $this->assertDatabaseMissing('photos', ['id' => $photo->id]);
        Storage::disk('public')->assertMissing('photos/hapus-test.jpg');
    }
}
