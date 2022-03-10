<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master\M_role;
use DB;

class RoleController extends Controller
{
    public function index()
    {
        return view('back.master.role');
    }

    public function datatable()
    {
        $datas = M_role::OrderBy('nama_role', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama_role;
            $data_tables[$key][] = $value->keterangan;

            if ($value->is_aktif == 1) {
                $data_tables[$key][] = '<center><span class="badge badge-success">AKTIF</span></center>';
            } else {
                $data_tables[$key][] = '<center><span class="badge badge-danger">NON AKTIF</span></center>';
            }

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_role="' . $value->id_role . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_role . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = new M_role;

        $data->nama_role    = $request->nama_role;
        $data->keterangan   = $request->keterangan;
        $data->is_aktif     = $request->aktif_menu ? 1 : 0;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function edit(Request $request)
    {
        $data   = M_role::findOrFail($request->role);

        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = M_role::findOrFail($request->id_role);

        $data->nama_role    = $request->nama_role;
        $data->keterangan   = $request->keterangan;
        $data->is_aktif     = $request->aktif_menu ? 1 : 0;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {

        $data = M_role::findOrFail($request->id);

        if ($data->delete()) {

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Terhapus!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Terhapus!',
            ]);
        }
    }
}
