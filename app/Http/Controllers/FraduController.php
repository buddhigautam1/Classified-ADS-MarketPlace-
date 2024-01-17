<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Fraud;
class FraduController extends Controller
{
    public function store(Request $request)
    {
        Fraud::create([
            'reason'=>$request->reason,
            'email'=>$request->email,
            'message'=>$request->message,
            'ad_id'=>$request->ad_id

        ]);
        return back()->with('message','Your report has been recorded. Thank you for the feedback');
    }

    //for admin section
    Public function index()
    {
        $ads = Fraud::paginate(20);
        return view('backend.fraud.index',compact('ads'));
    }
}
