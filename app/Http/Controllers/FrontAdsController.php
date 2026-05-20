<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Advertisement;
use Illuminate\Support\Collection;

class FrontAdsController extends Controller
{
    public function index()
    {
        $category = Category::CategoryCar();
        $categoryElectronic = Category::CategoryElectronic();

        $firstAds = $category
            ? Advertisement::firstFourAdsInCaurosel($category->id)
            : new Collection();

        $secondsAds = $category
            ? Advertisement::secondFourAdsInCaurosel($category->id)
            : new Collection();

        $firstAdsForElectronics = $categoryElectronic
            ? Advertisement::firstFourAdsInCauroselForElectronic($categoryElectronic->id)
            : new Collection();

        $secondsAdsForElectronics = $categoryElectronic
            ? Advertisement::secondFourAdsInCauroselForElectronic($categoryElectronic->id)
            : new Collection();

        $categories = Category::orderBy('name')->get();
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
