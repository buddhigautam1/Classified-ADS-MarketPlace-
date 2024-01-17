<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
class AdminListingController extends Controller
{
    public function index()
    {
        $ads = Advertisement::latest()->paginate(50);
        return view('backend.listing.index',compact('ads'));
    }
}
