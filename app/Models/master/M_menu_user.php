<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_menu_user extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_menu_user";
    protected $primaryKey = "id_menu_user";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function menu()
    {
        return $this->belongsTo('App\Models\Master\M_menu', 'id_menu');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Master\M_role', 'id_role');
    }
}
