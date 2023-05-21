<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class BookingGym extends Model
{
    use HasFactory;
    protected $fillable =[
        'no_booking_gym',
        'id_member',
        'tgl_booking_gym',
        'tgl_reservasi_gym',
        'id_gym',
        'jam_presensi_gym',
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

    public function gym(){
        return $this->belongsTo(Gym::class, 'id_gym', 'id');
    }


}