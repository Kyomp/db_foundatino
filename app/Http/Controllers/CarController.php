<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    //
    public function show(){
        $ID = Auth::user();
        if($ID->getIdentification()->get()->isEmpty()){
            if($ID->foreigner){
                return redirect('/foreigner');
            }
            else{
                return redirect('/citizen');
            }
            
        }
        $car_types = DB::table('car_types')
                        ->whereIn('id', 
                                    DB::table('cars')
                                        ->select('car_type_id')
                                        ->where('availability', true)
                                        ->groupBy('car_type_id')
                                )->get();

        $hasExistingContract = (new ContractController)->checkIfHasExistingContract();
        return view('dashboard', ['car_types' => $car_types, 'hasExistingContract' => $hasExistingContract]);
    }
}
