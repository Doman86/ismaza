<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
{
    /**
     * Siapa yang boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image'       => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ];
    }

    /**
     * Pesan error dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'title.required'   => 'Judul foto wajib diisi.',
            'title.max'        => 'Judul foto maksimal 255 karakter.',
            'description.max'  => 'Deskripsi maksimal 2000 karakter.',
            'image.required'   => 'Foto wajib dipilih.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format foto harus jpg, jpeg, png, atau webp.',
            'image.max'        => 'Ukuran foto maksimal 8 MB.',
            'image.uploaded'   => 'Upload gagal. Ukuran file mungkin terlalu besar.',
        ];
    }
}
