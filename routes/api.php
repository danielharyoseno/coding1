<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('email/verify/{id}', [VerifController::class, 'verify'])->name('verification.verify'); // Make sure to keep this as your route name
// Route::get('email/resend', [VerifController::class, 'resend'])->name('verification.resend');

// Route::post('register','Api\AuthController@register');
// Route::post('login','Api\AuthController@login');

Route::apiResource('/kelas', App\Http\Controllers\KelasController::class);
Route::apiResource('/instruktur', App\Http\Controllers\InstrukturController::class);
Route::apiResource('/promo', App\Http\Controllers\PromoController::class);
Route::apiResource('/pegawai', App\Http\Controllers\PegawaiController::class);
Route::apiResource('/member', App\Http\Controllers\MemberController::class);
Route::apiResource('/user', App\Http\Controllers\UserController::class);
Route::apiResource('/jadwalumum', App\Http\Controllers\JadwalUmumController::class);
Route::apiResource('/transaksiDeposit', App\Http\Controllers\TransaksiDepositController::class);
Route::apiResource('/jadwalharian', App\Http\Controllers\JadwalHarianController::class);
Route::apiResource('/transaksiAktivasi', App\Http\Controllers\TransaksiAktivasiController::class);
Route::apiResource('/transaksiKelas', App\Http\Controllers\TransaksiKelasController::class);
Route::apiResource('/depositKelas', App\Http\Controllers\DepositKelasController::class);
Route::apiResource('/ijinInstruktur', App\Http\Controllers\IjinInstrukturController::class);

Route::get('/memberKedaluwarsa', [App\Http\Controllers\DeaktivasiController::class, 'memberKadeluarsa']);
Route::get('/deaktivasiMember', [App\Http\Controllers\DeaktivasiController::class, 'memberDeaktivasi']);

Route::get('/absenInstruktur', [App\Http\Controllers\DeaktivasiController::class, 'absenInstruktur']);
Route::get('/resetInstruktur', [App\Http\Controllers\DeaktivasiController::class, 'resetInstruktur']);

//booking
Route::apiResource('/bookingGym', App\Http\Controllers\BookingGymController::class);