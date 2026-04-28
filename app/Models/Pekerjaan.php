<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'prioritas',
        'status',
        'assigned_to',
        'created_by',
        'deadline',
        'catatan_penyelesaian',
        'selesai_at',
    ];

    protected $casts = [
        'deadline' => 'date',
        'selesai_at' => 'datetime',
    ];

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function badgePrioritas(): string
    {
        return match ($this->prioritas) {
            'tinggi' => 'Tinggi',
            'sedang' => 'Sedang',
            'rendah' => 'Rendah',
            default => '-',
        };
    }

    public function badgeStatus(): string
    {
        return match ($this->status) {
            'menunggu' => 'Menunggu',
            'dikerjakan' => 'Dikerjakan',
            'selesai' => 'Selesai',
            default => '-',
        };
    }
}
