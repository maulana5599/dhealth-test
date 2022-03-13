<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
