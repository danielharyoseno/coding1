<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\KelasResource;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->get();
        //render view with posts
        return new KelasResource(
            true,
            'List Data Kelas',
            $kelas
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'jumlah_peserta' => 'required',
            'harga_kelas' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'jumlah_peserta' => $request->jumlah_peserta,
            'harga_kelas' => $request->harga_kelas
        ]);
        return new KelasResource(true, 'Data Kelas Berhasil Ditambahkan!', $kelas);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'jumlah_peserta' => 'required',
            'harga_kelas' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'jumlah_peserta' => $request->jumlah_peserta,
            'harga_kelas' => $request->harga_kelas
        ]);
        return new KelasResource(true, 'Data Kelas berhasil diubah!', $kelas);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return new KelasResource(true, 'Data Kelas berhasil dihapus!', $kelas);
    }

    public function show($id)
    {
        $kelas= Kelas::find($id);

        if(!is_null($kelas)){
            return response([
                'message' => 'Data Kelas Ditemukan',
                'data' => $kelas
            ], 200);
        }

        return response([
            'message' => 'Data Kelas Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }


}