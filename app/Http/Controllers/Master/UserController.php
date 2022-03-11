<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\M_user;
use App\Models\master\M_menu;
use App\Models\master\M_role;
use App\Models\master\M_menu_user;
use DB;

class UserController extends Controller
{
    public function index()
    {
        return view('back.master.user');
    }

    public function datatable()
    {
        $datas = M_user::OrderBy('id_user', 'ASC')->get();

        $data_tables = [];

        foreach ($datas as $key => $value) {

            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama;
            $data_tables[$key][] = $value->username;

            if ($value->is_aktif == 1) {
                $data_tables[$key][] = '<center><span class="badge badge-success">AKTIF</span></center>';
            } else {
                $data_tables[$key][] = '<center><span class="badge badge-danger">NON AKTIF</span></center>';
            }

            $data_tables[$key][] = $value->jabatan;

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_user="' . $value->id_user . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_user . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function menu_user($id)
    {
        $id_user = decrypt($id);
        $user = M_user::findOrFail($id_user);
        $menu = M_menu::whereIn('status',['0','1'])->OrderBy('urutan','ASC')->get();

        foreach($menu as $value){
            $value->sub = M_menu::where('parent_id',$value->id_menu)->where('status',3)->get();
            foreach($value->sub as $item){
                $item->sub_child = M_menu::where('sub_parent_id',$item->id_menu)->where('status',4)->get();
            }
            $value->menu_user = M_menu_user::where('id_user',$id_user)->where('id_menu',$value->id_menu)->first();
        }
        

        $data = [
            'id_user' => $id_user,
            'user'    => $user,
            'menu'    => $menu,
        ];

        return view('back.master.menuuser',$data);
    }

    public function store(Request $request)
    {
        $data = new M_user;

        $data->nama             = $request->nama_user;
        $data->username         = $request->username;
        $data->password_old     = Hash::make($request->password);
        $data->see_password_old = $request->password;
        $data->password         = Hash::make($request->password);
        $data->see_password     = $request->password;
        $data->is_aktif         = $request->aktif_user ? 1 : 0;
        $data->jabatan          = $request->jabatan;
        
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
}
