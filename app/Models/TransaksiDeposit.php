<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransaksiDeposit extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_struk_deposit';
    protected $fillable =[
        'no_struk_deposit',
        'id_promo',
        'id_member',
        'id_pegawai',
        'tgl_deposit',
        'nominal_deposit',
        'bonus_deposit',
        'total_deposit',
    ];

    protected $casts = [
        'no_struk_deposit' => 'string'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');

    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');

    }
    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo', 'id');

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