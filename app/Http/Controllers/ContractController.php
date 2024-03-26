<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ContractController extends Controller
{
    //
    public function checkIfHasExistingContract(){
        return DB::table('contracts')->where('user_id', Auth::user()->id)->get()->isNotEmpty();
    }
    public function show($id){
        $car_type = DB::table('car_types')
                            ->where('id', $id)
                            ->get()
                            ->first();
        $cars = DB::table('cars')
                        ->where('car_type_id',$id)
                        ->where('availability', true)
                        ->join('branches', 'cars.branch_id', '=', 'branches.id')
                        ->select('cars.id', 'cars.color', 'branches.country', 'branches.province', 'branches.city')
                        ->get();

        $hasExistingContract = $this->checkIfHasExistingContract();

        return view('userPages.bookingPage', ['cars' => $cars, 'car_type' => $car_type, 'hasExistingContract' => $hasExistingContract]);
    }

    public function store(Request $request){

        if($this->checkIfHasExistingContract()){
            return redirect('/return');
        }

        $request->validate([
            'selected_car_id' => ['required', 'integer'],
            'start_date' => ['required', 'date', 'after:today', 'before: +2 week'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);

        $price_rate = DB::table('car_types')
                            ->select('price_rate')
                            ->where('id', DB::table('cars')
                                                ->select('car_type_id')
                                                ->where('id', $request->input('selected_car_id')
                                                ))
                            ->first()
                            ->price_rate;

        $price = ((strtotime($request->input('end_date')) - strtotime($request->input('start_date')))/ (60 * 60 * 24)) * $price_rate;

        DB::table('contracts')->insert([
            'user_id' => Auth::user()->id,
            'car_id' => $request->input('selected_car_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'price' => $price,
        ]);

        DB::table('cars')
                ->where('id', $request->input('selected_car_id'))
                ->update(['availability' => false]);

        return redirect()->route('dashboard');
    }

    public function showReturn(){
        $borrowedCar = DB::table('contracts')
                            ->where('user_id', Auth::id())
                            ->join('cars', 'contracts.car_id', '=', 'cars.id')
                            ->join('car_types', 'cars.car_type_id', '=', 'car_types.id')
                            ->select('contracts.id', 'contracts.car_id', 'contracts.start_date', 'contracts.end_date', 'car_types.brand', 'car_types.model', 'cars.color')
                            ->get()
                            ->first();

        return view('userPages.returnPage', ['car' => $borrowedCar]);
    }

    public function destroy(Request $request){
        $request->validate([
            'contract_id' => ['required'],
            'car_id' => ['required'],
        ]);
        DB::table('contracts')
                ->where('id', $request->input('contract_id'))
                ->delete();

        DB::table('cars')
                ->where('id', $request->input('contract_id'))
                ->update(['availability'=>true]);
            
        return redirect()->route('dashboard');
    }
}
