<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // KITA TAMBAHKAN 'type' DISINI
    protected $fillable = ['name', 'user_id', 'type'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}