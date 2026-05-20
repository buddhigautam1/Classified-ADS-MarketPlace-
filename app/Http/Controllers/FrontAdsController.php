<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;

class FrontAdsController extends Controller
{
    public function index()
    {

        //for category car
        $category = Category::categoryCar()->first();
        $firstAds = collect();
        $secondsAds = collect();

        if ($category) {
            $firstAds = Advertisement::firstFourAdsInCaurosel($category->id);
            $secondsAds = Advertisement::secondFourAdsInCaurosel($category->id);
        }

        //for category electronic
        $categoryElectronic = Category::categoryElectronic()->first();
        $firstAdsForElectronics = collect();
        $secondsAdsForElectronics = collect();

        if ($categoryElectronic) {
            $firstAdsForElectronics = Advertisement::firstFourAdsInCauroselForElectronic(
                $categoryElectronic->id
            );
            $secondsAdsForElectronics = Advertisement::secondFourAdsInCauroselForElectronic(
                $categoryElectronic->id
            );
        }

        // get all categories
        $categories = Category::get();
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
