<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class MasterObat extends Model
{
    use HasFactory;

    protected $guard = ['delete_by'];

    protected $table = 'obatalkes_m';


    public function FindAll($skip, $take, $request)
    {
       
        $query = MasterObat::skip($skip)->take($take);


        if ($request->dataField) {
            $query = MasterObat::select($request->dataField)->groupBy($request->dataField);
        } 
        
        if ($request->filterValue) {
            $query = $query->where($request->filterColumn, 'like', '%' . $request->filterValue . '%');
        }

        if (!$request->filterValue) {
            if ($request->filterColumn) {
                $query = $query->where($request->filterColumn[0], 'like', '%' . $request->filterColumn[2] . '%');
            }
        }

        if ($request->orderby) {
            $query = $query->orderByRaw($request->orderby);
        }

        $res = $query->get()->all();


        return $res;
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

    public function AllObat()
    {
        $query = MasterObat::get();
        return $query;
    }


}
