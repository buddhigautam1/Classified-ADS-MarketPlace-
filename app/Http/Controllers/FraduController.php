<?php

namespace App\Http\Controllers;

use App\Models\Fraud;
use Illuminate\Http\Request;

class FraduController extends Controller
{
    public function store(Request $request)
    {
        Fraud::create([
            'reason' => $request->reason,
            'email' => $request->email,
            'message' => $request->message,
            'ad_id' => $request->ad_id,

        ]);

        return back()->with('message', 'Your report has been recorded. Thank you for the feedback');
    }

    //for admin section
    public function index()
    {
        $ads = Fraud::with('advertisement')->paginate(20);

        return view('backend.fraud.index', compact('ads'));
    }
}
