<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookingKelas extends Model
{
    use HasFactory;
    protected $fillable =[
        'no_booking_gym',
        'id_member',
        'id_harian',
        'id_deposit',
        'tgl_booking_kelas',
        'tgl_reservasi_kelas',
        'waktu_presensi_kelas',
        'status_presensi',
        'tipe_booking',
    ];

    
    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }

    public function member(){
        return $this->belongsTo(member::class, 'id_member', 'id');
    }

    public function harian(){
        return $this->belongsTo(JadwalHarian::class, 'id_harian', 'id');
    }
    public function deposit(){
        return $this->belongsTo(depositKelas::class, 'id_deposit', 'id');
    }

}