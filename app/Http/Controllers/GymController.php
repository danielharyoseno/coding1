<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PegawaiResource;
class GymController extends Controller
{
    public function index()
    {
        $gym = Gym::latest()->get();
        //render view with posts
        return new PegawaiResource(
            true,
            'List Data Gym',
            $pegawai
        );
    }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'jabatan' => 'required',
    //         'nama_pegawai' => 'required',
    //         'notel_pegawai' => 'required',
    //         'email_pegawai' => 'required'
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }
    //     $pegawai = Pegawai::findOrFail($id);
    //     $pegawai->update([
    //         'jabatan' => $request->jabatan,
    //         'nama_pegawai' => $request->nama_pegawai,
    //         'notel_pegawai' => $request->notel_pegawai,
    //         'email_pegawai' => $request->email_pegawai
    //     ]);
    //     return new PegawaiResource(true, 'Data Pegawai berhasil diubah!', $pegawai);
    // }

    public function destroy($id)
    {
        $gym = Gym::findOrFail($id);
        $gym->delete();
        return new PegawaiResource(true, 'Data Gym berhasil dihapus!', $pegawai);
    }


    public function show($id)
    {
        $gym = Gym::find($id);

        if(!is_null($pegawai)){
            return response([
                'message' => 'Data Gym Ditemukan',
                'data' => $gym
            ], 200);
        }

        return response([
            'message' => 'Data Gym Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }
}