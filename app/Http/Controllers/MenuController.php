<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    public function menu()
    {
        return app(FrontAdsController::class)->index();
    }
}
