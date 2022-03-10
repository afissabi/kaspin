<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master\M_barang;
use App\Models\t_barang;
use App\Models\stok_barang;
use Carbon\Carbon;
use DB;

class BarangController extends Controller
{
    public function index(){
        return view('back.master.barang');
    }

    public function datatable()
    {
        $datas = M_barang::OrderBy('kd_barang', 'ASC')->get();
        $user = session('user')->jabatan;

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->kd_barang;
            $data_tables[$key][] = $value->nama_barang;
            $data_tables[$key][] = $value->satuan_barang;
            $data_tables[$key][] = $value->keterangan;

            $aksi = '';
            
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_barang="' . $value->id_barang . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            if($user == 'admin'){
                $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_barang . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';
            }

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
        $data = new M_barang;

        $q=DB::table('m_barang')->select(DB::raw('MAX(RIGHT('."kd_barang".',6)) as kd_max'));

		$kategori = 'brg-';

        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $kategori . sprintf("%06s", $tmp);
            }
        }
        else
        {
            $kd = $kategori . "000001";
        }

        $data->kd_barang        = $kd;
        $data->nama_barang      = $request->nama;
        $data->keterangan       = $request->keterangan;
        $data->satuan_barang    = $request->satuan;
        
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
        $data   = M_barang::findOrFail($request->id_barang);
        
        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = M_barang::findOrFail($request->id_barang);

        $data->nama_barang      = $request->nama;
        $data->keterangan       = $request->keterangan;
        $data->satuan_barang    = $request->satuan;

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

        $data = M_barang::findOrFail($request->id_barang);

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

    public function masuk(){
        $barang = M_barang::all();

        $data = [
            'barang' => $barang,
        ];

        return view('back.barang.masuk',$data);
    }

    public function datatablemasuk()
    {
        $datas = t_barang::where('status_transaksi','1')->OrderBy('tanggal', 'DESC')->get();
        $user = session('user')->jabatan;

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = \Carbon\Carbon::parse($value->tanggal)->format('d-m-Y');
            $data_tables[$key][] = $value->barang->kd_barang;
            $data_tables[$key][] = $value->barang->nama_barang;
            $data_tables[$key][] = $value->barang->satuan_barang;
            $data_tables[$key][] = $value->jumlah_sebelum;
            $data_tables[$key][] = $value->jumlah;
            $data_tables[$key][] = $value->catatan;

            $aksi = '';
            
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_t_barang="' . $value->id_t_barang . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            if($user == 'admin'){
                $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_t_barang . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';
            }

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function storemasuk(Request $request)
    {
        $data = new t_barang;

        $data->tanggal          = $request->tanggal;
        $data->kd_barang        = $request->barang;
        $data->status_transaksi = 1;
        $data->jumlah           = $request->jumlah;
        $data->catatan          = $request->catatan;
        
        $jum = M_barang::findOrFail($request->barang);
        $data->jumlah_sebelum   = $jum->stok;
        $jum->stok  = $jum->stok + $request->jumlah;
        
        try {
            $data->save();
            $jum->save();

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

    public function editmasuk(Request $request)
    {
        $data    = t_barang::findOrFail($request->id_t_barang);
        $cek     = M_barang::findOrFail($data->kd_barang);
        $barang  = $cek->kd_barang . ' | ' . $cek->nama_barang;
        $tanggal = $data->tanggal;
        $jumlah  = $data->jumlah;
        $catatan = $data->catatan;

        return response()->json([
            'data'  => $data,
            'barang' => $barang,
            'tanggal' => $tanggal,
            'jumlah' => $jumlah,
            'catatan' => $catatan,
            'id_t_barang' => $request->id_t_barang,
        ]);
        
        // return response()->json($data);
    }

    public function ubahmasuk(Request $request)
    {
        $data  = t_barang::findOrFail($request->id_t_barang);

        $data->tanggal          = $request->tanggal;
        $data->status_transaksi = 1;
        $data->jumlah           = $request->jumlah;
        $data->catatan          = $request->catatan;

        $jum = M_barang::findOrFail($data->kd_barang);
        $data->jumlah_sebelum   = $jum->stok - $request->jum_sebelum;
        $stok_baru = $jum->stok - $request->jum_sebelum + $request->jumlah;
        $jum->stok  = $stok_baru;
        
        try {
            $data->save();
            $jum->save();

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

    public function destroymasuk(Request $request)
    {
        $data  = t_barang::findOrFail($request->id_t_barang);

        $jum = M_barang::findOrFail($data->kd_barang);
        $stok_baru = $jum->stok - $data->jumlah;
        $jum->stok = $stok_baru;
        
        if ($data->delete()) {
            $jum->save();
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

    public function keluar()
    {
        $barang = M_barang::all();

        $data = [
            'barang' => $barang,
        ];

        return view('back.barang.keluar', $data);
    }

    public function datatablekeluar()
    {
        $datas = t_barang::where('status_transaksi', '0')->OrderBy('tanggal', 'DESC')->get();
        $user = session('user')->jabatan;

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = \Carbon\Carbon::parse($value->tanggal)->format('d-m-Y');
            $data_tables[$key][] = $value->barang->kd_barang;
            $data_tables[$key][] = $value->barang->nama_barang;
            $data_tables[$key][] = $value->barang->satuan_barang;
            $data_tables[$key][] = $value->jumlah_sebelum;
            $data_tables[$key][] = $value->jumlah;
            $data_tables[$key][] = $value->catatan;

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_t_barang="' . $value->id_t_barang . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            if ($user == 'admin') {
                $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_t_barang . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';
            }

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        // dd($datas);
        return response()->json($data);
    }

    public function storekeluar(Request $request)
    {
        $data = new t_barang;

        $data->tanggal          = $request->tanggal;
        $data->kd_barang        = $request->barang;
        $data->status_transaksi = 0;
        $data->jumlah           = $request->jumlah;
        $data->catatan          = $request->catatan;

        $jum = M_barang::findOrFail($request->barang);
        $data->jumlah_sebelum   = $jum->stok;
        $jum->stok  = $jum->stok - $request->jumlah;

        try {
            $data->save();
            $jum->save();

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

    public function editkeluar(Request $request)
    {
        $data    = t_barang::findOrFail($request->id_t_barang);
        $cek     = M_barang::findOrFail($data->kd_barang);
        $barang  = $cek->kd_barang . ' | ' . $cek->nama_barang;
        $tanggal = $data->tanggal;
        $jumlah  = $data->jumlah;
        $catatan = $data->catatan;

        return response()->json([
            'data'          => $data,
            'barang'        => $barang,
            'tanggal'       => $tanggal,
            'jumlah'        => $jumlah,
            'catatan'       => $catatan,
            'id_t_barang'   => $request->id_t_barang,
        ]);

        // return response()->json($data);
    }

    public function ubahkeluar(Request $request)
    {
        $data  = t_barang::findOrFail($request->id_t_barang);

        $data->tanggal          = $request->tanggal;
        $data->status_transaksi = 0;
        $data->jumlah           = $request->jumlah;
        $data->catatan          = $request->catatan;

        $jum = M_barang::findOrFail($data->kd_barang);
        $data->jumlah_sebelum   = $jum->stok + $request->jum_sebelum;
        $stok_baru = $jum->stok + $request->jum_sebelum - $request->jumlah;
        $jum->stok  = $stok_baru;

        try {
            $data->save();
            $jum->save();

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

    public function destroykeluar(Request $request)
    {
        $data  = t_barang::findOrFail($request->id_t_barang);

        $jum = M_barang::findOrFail($data->kd_barang);
        $stok_baru = $jum->stok + $data->jumlah;
        $jum->stok = $stok_baru;

        if ($data->delete()) {
            $jum->save();
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

    public function stokbarang()
    {
        $barang = M_barang::all();

        $data = [
            'barang' => $barang,
        ];

        return view('back.barang.stok', $data);
    }

    public function datatablestok()
    {
        $datas = M_barang::OrderBy('kd_barang', 'ASC')->get();
        $user = session('user')->jabatan;

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
