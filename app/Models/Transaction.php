<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Kolom mana saja yang boleh diisi manual
    protected $fillable = [
        'user_id',
        'category_id',
        'description',
        'amount',
        'type',
        'date'
    ];

    // Relasi: Transaksi ini milik Kategori apa?
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Transaksi ini milik User siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}