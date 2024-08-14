<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['notes', 'user_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
