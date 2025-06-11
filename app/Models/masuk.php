<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masuk extends Model
{
    use HasFactory;
    protected $table = 'masuk';
    protected $primaryKey = 'ID_MASUK';
    public $timestamps = false;
    protected $fillable =['ID_BARANG','TANGGAL_MASUK','JUMLAH_MASUK'];
    public function gudang(){
        return $this->belongsTo(gudang::class,'ID_BARANG');
    }
}
