<?php

namespace App\Http\Controllers;

use App\Models\MasterObat;
use Helper;
use Illuminate\Http\Request;

class MasterObatController extends Controller
{

    public function __construct()
    {
        $this->MasterObat = new MasterObat();
        $this->Helper = new Helper();
    }
    
    public function index()
    {
        return view('pages.obat.view');
    }

    public function DataObat(Request $request)
    {
        $data  = $this->MasterObat->FindAll($request->skip, $request->take);
        $count = $this->MasterObat->CountAll();

        $data = array(
            'status'    => $this->Helper->httpStatusOk(),
            'data'      => $data,
            'count'     => $count,
        );

        return response()->json($data);
    }
}
