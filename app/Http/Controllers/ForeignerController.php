<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ForeignerController extends Controller
{
    //
    public function showForm(){
        return view('userPages.foreignerForm');
    }

    public function store(Request $request){
        $request->validate([
            'country' => ['required', 'string'],
            'passport_no' => ['required', Rule::unique('foreigners')->where(function ($query) use($request) {
                return $query->where('passport_no', $request->input('passport_no'))
                ->where('country', $request->input('country'));
            }), 'string'],
            'issued_at' => ['required', 'string'],
            'issue_date' => ['required', 'date', 'before_or_equal:today'],
            'expiry_date' => ['required', 'date', 'after: +6 month'],
        ]);

        DB::table('foreigners')->insert([
            'passport_no' => $request->input('passport_no'),
            'country' => $request->input('country'),
            'issued_at' => $request->input('issued_at'),
            'issue_date' => $request->input('issue_date'),
            'expiry_date' => $request->input('expiry_date'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard');
    }
}
