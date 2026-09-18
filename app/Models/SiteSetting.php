<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Ambil nilai setting berdasarkan key, dengan fallback.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        $setting = static::query()->where('key', $key)->first();

        if (! $setting || $setting->value === null || trim($setting->value) === '') {
            return $default;
        }

        return $setting->value;
    }

    /**
     * Simpan (atau perbarui) nilai setting.
     */
    public static function set(string $key, ?string $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
