<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_role";
    protected $primaryKey = "id_role";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
