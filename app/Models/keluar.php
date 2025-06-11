<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keluar extends Model
{
    use HasFactory;
    protected $table = 'keluar';
    protected $primaryKey = 'ID_KELUAR';
    public $timestamps = false;
    protected $fillable =['ID_BARANG','TANGGAL_KELUAR','JUMLAH_KELUAR','LOKASI'];
    public function gudang(){
        return $this->belongsTo(gudang::class,'ID_BARANG');
    }
}
