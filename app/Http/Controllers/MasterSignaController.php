<?php

namespace App\Http\Controllers;

use App\Models\MasterSigna;
use Illuminate\Http\Request;
use Helper;
class MasterSignaController extends Controller
{

    public function __construct(){

        $this->MasterSigna = new MasterSigna();
        $this->Helper = new Helper();
    }
 
    public function index()
    {
        return view('pages.signa.view');
    }

    public function DataSigna(Request $request)
    {
         $data  = $this->MasterSigna->FindAll($request->skip, $request->take);
         $count = $this->MasterSigna->CountAll();
         $data = array(
            'status'    => $this->Helper->httpStatusOk(),
            'data'      => $data,
            'count'     => $count,
        );
        return response()->json($data);
    }

    public function AllSigna()
    {
        $data  = $this->MasterSigna->AllSigna();
        $data  = array(
            'status'    => $this->Helper->httpStatusOk(),
            'data'      => $data,
        );
        return response()->json($data);
    }
}
