<?php

namespace App\Http\Controllers;

use App\Models\MasterSigna;
use Illuminate\Http\Request;

class MasterSignaController extends Controller
{

    public function __construct(){

        $this->MasterSigna = new MasterSigna();
    }
 
    public function index()
    {
        $data = $this->MasterSigna->FindAll();
        return view('pages.signa.view', compact('data'));
    }
}
