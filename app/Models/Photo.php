<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];

    /**
     * URL foto untuk ditampilkan di view.
     */
    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->image_path);
    }

    /**
     * Hapus file fisik dari storage.
     */
    public function deleteImageFile(): void
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            Storage::disk('public')->delete($this->image_path);
        }
    }
}
