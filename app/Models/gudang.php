<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gudang extends Model
{
    use HasFactory;
    protected $table = 'gudang';
    protected $primaryKey = 'ID_BARANG';
    public $timestamps = false;
    protected $fillable =['id_user','NAMA','JUMLAH','SATUAN'];
    public function masuk()
    {
        return $this->hasMany(masuk::class);
    }
    public function keluar()
    {
        return $this->hasMany(keluar::class);
    }
}
