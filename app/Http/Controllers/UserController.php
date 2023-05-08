<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();
        //render view with posts
        return new UserResource(
            true,
            'List Data User',
            $user
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);
        return new UserResource(true, 'Data User Berhasil Ditambahkan!', $user);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);
        return new UserResource(true, 'Data User berhasil diubah!', $user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return new UserResource(true, 'Data User berhasil dihapus!', $user);
    }


    public function show($id)
    {
        $user= User::find($id);

        if(!is_null($user)){
            return response([
                'message' => 'Data User Ditemukan',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Data User Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }
}