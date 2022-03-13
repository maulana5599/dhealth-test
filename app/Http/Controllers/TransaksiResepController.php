<?php

namespace App\Http\Controllers;

use App\Models\TransaksiJumlah;
use App\Models\TransaksiResep;
use Helper;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class TransaksiResepController extends Controller
{
    
    public function __construct(){

        $this->ModelResep = new TransaksiResep();
        $this->ModelTransaksiObat = new TransaksiJumlah();
    }

    public function index()
    {
        return view('pages.obat.view_resep');
    }


    public function GetPage($page)

    {
        $configView = Config::get('configview.tab.'.$page);
        $data = [];
        $view = view($configView, $data)->render();
        $data = array('status' => 200, 'data' => $view);
        return response()->json($data);
   
    }

    public function save(Request $request)
    {

        try {
            DB::beginTransaction();


            $data = array(
                "public_id"  => Str::uuid(),
                "nama_resep" => $request->nama_resep,
                "signa"      => $request->signa,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
    
            $idResep = $this->ModelResep->SaveResep($data);
            
            
            foreach ($request->nama_obat as $index => $value) {
                
                $JumlahObat = array(
                        'id_resep' => $idResep,
                        'id_obat'  => $value,
                        'qty'      => $request->jumlah_obat[$index],
                    );
                $this->ModelTransaksiObat->SaveJumlah($JumlahObat);
            }
           

            DB::commit();
            return response()->json(array('status' => 200, 'message' => "Create data success"));
            
        } catch (\Throwable $th) {
            
            DB::rollBack();
            return response()->json(array('status' => 500, 'message' => $th->getMessage()));
        }

        
    }


    public function SaveNonRacikan(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = array(
                "public_id"  => Str::uuid(),
                "nama_resep" => $request->nama_resep,
                "signa"      => $request->signa,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
    
            $idResep = $this->ModelResep->SaveResep($data);

            $JumlahObat = array(
                'id_resep' => $idResep,
                'id_obat'  => $request->nama_obat,
                'qty'      => $request->jumlah_obat,
            );

            TransaksiJumlah::create($JumlahObat);

            DB::commit();
            return response()->json(array('status' => 200, 'message' => "Create data success"));
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(array('status' => 500, 'message' => $th->getMessage()));
        }
    }


    
}
