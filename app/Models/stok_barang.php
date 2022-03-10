<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class stok_barang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "stok_barang";
    protected $primaryKey = "id_stok_barang";
    protected $guarded = [];

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo('App\Models\Master\M_barang', 'kd_barang');
    }
}
