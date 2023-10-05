<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\DB;
use App\Models\Akar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProsesController extends Controller
{
    //
    public function tampil(){
        #Tampilkan 2 data terbaru
        $response = Akar::latest('id')->take(2)->get(); 

        #Return Ke data ke tampian
        return view('kalkulator.akar',compact('response'));
    }


    public function postAPI(Request $request){
        #set waktu mulai
        $start_time = microtime(true); 

        #Melakukan Validasi
        $valid = Validator::make($request->all(), [
            'bilangan' => 'required|numeric|min:0|max:10000',
        ]);

        if(!$valid->fails()){
            #Panggil API Backend
            Http::post('http://127.0.0.1:8000/api/hitung-akar',[
                'number' => $request->bilangan,
            ]);
            
            # Set Time Selesai
            $end_time = microtime(true); 
    
            #Hitung Selisih Waktu
            $execution_time = ($end_time - $start_time); 
    
            #Update Data Waktu Perhitungan
            $response = Akar::latest('id')->first();
            $response->waktu = $execution_time;
            $response->update();
      
            return redirect('/');
            #Return Redirect ke route tampilan
        }else{
            // Tangani validasi gagal di sini, misalnya dengan mengembalikan pesan kesalahan
            return redirect('/')->withErrors($valid)->withInput();;
        }

    }

    public function postPLSQL(Request $request){

        #Set Waktu Mulai
        $start_time = microtime(true); 
        
        #Melakukan Request Validasi
        $valid = Validator::make($request->all(), [
            'bil' => 'required|numeric|min:0|max:10000',
        ]);

        if(!$valid->fails()){
            #Panggil PLSQL
            DB::select('CALL hitungAkar(?)', array($request->bil));
    
            #Set Time Selesai
            $end_time = microtime(true);
            $execution_time = ($end_time - $start_time);
            
            #Update Data Waktu di Pada Data terbaru
            $response = Akar::latest('id')->first();
            $response->waktu = $execution_time;
            $response->update();
            
            #Kembalikan ke tampilan route /
            return redirect('/');
        }else{
            // Tangani validasi gagal di sini, misalnya dengan mengembalikan pesan kesalahan
            return redirect('/')->withErrors($valid)->withInput();;
        }
    }
}