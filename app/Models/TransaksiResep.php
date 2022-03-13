<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TransaksiResep extends Model
{
    use HasFactory;
    protected $table = "table_resep_obat";
    protected $fillable = ['*'];


    public function SaveResep($data)
    {
        $query = TransaksiResep::insertGetId($data);
        return $query;
    }

    public function resep()
    {
        return $this->hasMany(TransaksiJumlah::class, 'id_resep', 'id');
    }
}
