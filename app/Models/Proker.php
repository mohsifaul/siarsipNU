<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Proker extends Model
{
    use HasFactory;

    protected $table = 'prokers';
    protected $fillable = [
        'nama_program',
        'deskripsi',
        'tanggal_pelaksanaan',
        'tempat',
        'penanggung_jawab',
        'divisi',
        'anggaran',
        'status',
        'file_proposal',
        'file_kepanitiaan',
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
