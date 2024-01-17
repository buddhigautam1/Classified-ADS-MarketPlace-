<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Childcategory;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use App\Models\User;

class Advertisement extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function displayVideoFromLink()
    {
       
    }

    public function childcategory()
    {
        return $this->hasOne(Childcategory::class, 'id', 'childcategory_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(city::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //save ads relations
    public function userads()
    {
        return $this->belongsToMany(User::class);
    }

    //check if user already saved the ad
    public function didUserSavedAd()
    {
        return DB::table('advertisement_user')
            ->where('user_id',auth()->user()->id)
            ->where('advertisement_id',$this->id)
            ->first();
    }
    //scope method for car

   public function scopeFirstFourAdsInCaurosel($query,$categoryId)
   {
       return $query->where('category_id', $categoryId)
       ->orderByDesc('id')->take(6)->get();
   }

   public function scopeSecondFourAdsInCaurosel($query,$categoryId)
   {
       $firstAds = $this->scopeFirstFourAdsInCaurosel($query,$categoryId);
       return $query->where('category_id', $categoryId)
       ->whereNotIn('id',$firstAds->pluck('id')->toArray())
        ->take(6)->get();
   }

   //scope method for category electronic

   public function scopeFirstFourAdsInCauroselForElectronic($query,$categoryId)
   {
       return $query->where('category_id', $categoryId)
       ->orderByDesc('id')->take(6)->get();
   }

   public function scopeSecondFourAdsInCauroselForElectronic($query,$categoryId)
   {
       $firstAds = $this->scopeFirstFourAdsInCaurosel($query,$categoryId);
       return $query->where('category_id', $categoryId)
       ->whereNotIn('id',$firstAds->pluck('id')->toArray())
        ->take(6)->get();
   }

 


  
}
