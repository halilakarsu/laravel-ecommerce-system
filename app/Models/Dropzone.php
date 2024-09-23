<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropzone extends Model
{
    use HasFactory;
    public function dropzone()
    {
        return $this->belongsTo(Products::class, 'product_id');

}
}
