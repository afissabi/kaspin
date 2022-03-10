<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class M_barang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_barang";
    protected $primaryKey = "id_barang";
    protected $guarded = [];

    protected $dates = ["deleted_at"];
    public $timestamps = true;    
}
