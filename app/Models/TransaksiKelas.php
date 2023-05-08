<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransaksiKelas extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_struk_kelas';
    protected $fillable =[
        'no_struk_kelas',
        'id_promo',
        'id_member',
        'id_pegawai',
        'id_kelas',
        'tgl_deposit_kelas',
        'jmlh_kelas',
        'nominal_kelas',
        'expired_kelas',
    ];

    public function member()
    {
        return $this->belongsTo(memeber::class, 'id_member', 'id');

    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');

    }
    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id', 'id');

    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id', 'id');

    }
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
}