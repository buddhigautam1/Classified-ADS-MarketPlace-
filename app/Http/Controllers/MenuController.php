<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Advertisement;

class MenuController extends Controller
{
    public function menu()
    {
        $category = Advertisement::categoryCarId();
        $firstAds = Advertisement::firstFourAdsInCaurosel($category->id);
        dd($firstAds);
        $secondsAds = Advertisement::where('category_id', $category->id)
        ->whereNotIn('id',$firstAds->pluck('id')->toArray())
         ->take(4)->get();
       return view('index',compact('firstAds','secondsAds','category'));
    }
}
