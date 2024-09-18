<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Types extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'categori_id'); // kategori_id ile ilişkili
    }
}
