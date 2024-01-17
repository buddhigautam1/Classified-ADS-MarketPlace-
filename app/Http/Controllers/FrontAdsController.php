<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Advertisement;

class FrontAdsController extends Controller
{
    public function index()
    {

        //for category car
        $category = Category::CategoryCar();
        $firstAds = Advertisement::firstFourAdsInCaurosel($category->id);
        $secondsAds = Advertisement::secondFourAdsInCaurosel($category->id);
        //for category electronic
        $categoryElectronic = Category::CategoryElectronic();
        $firstAdsForElectronics = Advertisement::firstFourAdsInCauroselForElectronic(
            $categoryElectronic->id
        );
        // get all categories
        $categories = Category::get();
        $secondsAdsForElectronics = Advertisement::secondFourAdsInCauroselForElectronic(
            $categoryElectronic->id
        );
        $advertisements = Advertisement::latest()->paginate(30);
        




        return view('index', compact(
            'firstAds',
            'secondsAds',
            'category',
            'categoryElectronic',
            'firstAdsForElectronics',
            'secondsAdsForElectronics',
            'advertisements',
            'categories'
        ));
    }
}
