<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surats extends Model
{
    use HasFactory;

    protected $table ='surats';
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'pengirim',
        'perihal',
        'type',
        'status',
        'lampiran',
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
