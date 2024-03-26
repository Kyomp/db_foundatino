<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CitizenController extends Controller
{
    //
    public function showForm(){
        return view('userPages.citizenForm');
    }

    public function store(Request $request){
        $request->validate([
            'citizen_no' => ['required', 'unique:citizens,citizen_no', 'string'],
            'address' => ['required', 'string'],
            'issue_date' => ['required', 'date', 'before_or_equal:today'],
            'expiry_date' => ['required', 'date', 'after: +6 month'],
        ]);

        DB::table('citizens')->insert([
            'citizen_no' => $request->input('citizen_no'),
            'address' => $request->input('address'),
            'issue_date' => $request->input('issue_date'),
            'expiry_date' => $request->input('expiry_date'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard');
    }
}
