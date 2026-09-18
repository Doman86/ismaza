<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Daftar semua foto.
     */
    public function index()
    {
        return view('admin.photos.index', [
            'photos' => Photo::latest()->paginate(12),
        ]);
    }

    /**
     * Form tambah foto.
     */
    public function create()
    {
        return view('admin.photos.create');
    }

    /**
     * Simpan foto baru.
     */
    public function store(StorePhotoRequest $request)
    {
        $path = $request->file('image')->store('photos', 'public');

        Photo::create([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'image_path'  => $path,
        ]);

        return redirect()
            ->route('admin.photos.index')
            ->with('success', 'Foto berhasil diupload.');
    }

    /**
     * Form edit foto.
     */
    public function edit(Photo $photo)
    {
        return view('admin.photos.edit', [
            'photo' => $photo,
        ]);
    }

    /**
     * Update judul, deskripsi, dan/atau ganti foto.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            // Hapus file lama sebelum menyimpan yang baru
            $photo->deleteImageFile();

            $data['image_path'] = $request->file('image')->store('photos', 'public');
        }

        $photo->update($data);

        return redirect()
            ->route('admin.photos.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    /**
     * Hapus foto dari database DAN file fisiknya dari storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->deleteImageFile();
        $photo->delete();

        return redirect()
            ->route('admin.photos.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}
