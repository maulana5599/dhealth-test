<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiJumlah extends Model
{
    use HasFactory;
    protected $table = "table_transaksi_resep";
    protected $fillable = ['id_resep','id_obat','qty'];


    public function SaveJumlah($data)
    {
        TransaksiJumlah::create($data);
    }

}
