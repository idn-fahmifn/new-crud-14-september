<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $guarded;

    // relationship
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }


}
