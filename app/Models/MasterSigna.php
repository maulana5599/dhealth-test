<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSigna extends Model
{
    use HasFactory;

    protected $fillable = ['*'];
    protected $table ="signa_m";

    public function FindAll($skip, $take)
    {
       $query = MasterSigna::skip($skip)->take($take)->get();
       return $query;
    }

    public function FindById($id)
    {
        $query = MasterSigna::findById($id);
        return $query;
    }


    public function CountAll()
    {
        $query = MasterSigna::count();
        return $query;
    }
}
