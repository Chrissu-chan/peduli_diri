<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjalanan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','tanggal', 'jam', 'lokasi', 'suhu_tubuh'];

    public function view_users() {
        return $this->belongsTo(User::class);
    }
}
