<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PegawaiResource;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::latest()->get();
        //render view with posts
        return new PegawaiResource(
            true,
            'List Data Pegawai',
            $pegawai
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
            'nama_pegawai' => 'required',
            'notel_pegawai' => 'required',
            'email_pegawai' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $pegawai = Pegawai::create([
            'jabatan' => $request->jabatan,
            'nama_pegawai' => $request->nama_pegawai,
            'notel_pegawai' => $request->notel_pegawai,
            'email_pegawai' => $request->email_pegawai
        ]);
        return new PegawaiResource(true, 'Data Pegawai Berhasil Ditambahkan!', $pegawai);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
            'nama_pegawai' => 'required',
            'notel_pegawai' => 'required',
            'email_pegawai' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update([
            'jabatan' => $request->jabatan,
            'nama_pegawai' => $request->nama_pegawai,
            'notel_pegawai' => $request->notel_pegawai,
            'email_pegawai' => $request->email_pegawai
        ]);
        return new PegawaiResource(true, 'Data Pegawai berhasil diubah!', $pegawai);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return new PegawaiResource(true, 'Data Pegawai berhasil dihapus!', $pegawai);
    }


    public function show($id)
    {
        $pegawai= Pegawai::find($id);

        if(!is_null($pegawai)){
            return response([
                'message' => 'Data Pegawai Ditemukan',
                'data' => $pegawai
            ], 200);
        }

        return response([
            'message' => 'Data Pegawai Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }

}