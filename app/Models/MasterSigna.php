<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSigna extends Model
{
    use HasFactory;


    public function FindAll()
    {
       $data = MasterSigna::get();
       return $data;
    }

    public function FindById($id)
    {
        $data = MasterSigna::findById($id);
        return $data;
    }
}
