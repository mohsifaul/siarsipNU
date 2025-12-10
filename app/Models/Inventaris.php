<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventaris extends Model
{
    use HasFactory;
    protected $table = 'inventaris';

    protected $fillable = [
        'nama_barang',
        'kategori',
        'jumlah',
        'satuan',
        'penanggung_jawab',
        'keterangan',
        'jumlah_baik',
        'jumlah_perbaikan',
        'jumlah_rusak'
    ];
    public $incrementing = false; // Disable auto-incrementing IDs

    protected $keyType = 'string'; // Specify that the key type is string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // Generate UUID
            }
        });
    }
}
