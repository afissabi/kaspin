<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master\M_barang;

class TamuController extends Controller
{
    public function index(){
        return view('back.welcome.barang');
    }

    public function datatable()
    {
        $datas = M_barang::OrderBy('kd_barang', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->kd_barang;
            $data_tables[$key][] = $value->nama_barang;
            $data_tables[$key][] = $value->keterangan;
            $data_tables[$key][] = $value->stok;
            $data_tables[$key][] = $value->satuan_barang;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }
}
