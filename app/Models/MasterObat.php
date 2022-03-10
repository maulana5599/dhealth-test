<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterObat extends Model
{
    use HasFactory;

    protected $guard = ['delete_by'];

    protected $table = 'obatalkes_m';


    public function FindAll($skip, $take)
    {
        $query = MasterObat::skip($skip)->take($take)->get();
        return $query;
    }

    public function FindById($id)
    {
        $query = MasterObat::find($id);
        return $query;
    }

    public function CountAll()
    {
        $query = MasterObat::count();
        return $query;
    }
    


}
