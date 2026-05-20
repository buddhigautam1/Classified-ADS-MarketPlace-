<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsTo(City::class);
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
            ->where('user_id', auth()->user()->id)
            ->where('advertisement_id', $this->id)
            ->first();
    }
    //scope method for car

    public function scopeFirstFourAdsInCaurosel($query, $categoryId)
    {
        return $query->where('category_id', $categoryId)
            ->orderByDesc('id')->take(6)->get();
    }

    public function scopeSecondFourAdsInCaurosel($query, $categoryId)
    {
        $firstAdIds = Advertisement::where('category_id', $categoryId)
            ->orderByDesc('id')->take(6)->pluck('id')->toArray();

        return $query->where('category_id', $categoryId)
            ->whereNotIn('id', $firstAdIds)
            ->orderByDesc('id')->take(6)->get();
    }

   //scope method for category electronic

    public function scopeFirstFourAdsInCauroselForElectronic($query, $categoryId)
    {
        return $query->where('category_id', $categoryId)
            ->orderByDesc('id')->take(6)->get();
    }

    public function scopeSecondFourAdsInCauroselForElectronic($query, $categoryId)
    {
        $firstAdIds = Advertisement::where('category_id', $categoryId)
            ->orderByDesc('id')->take(6)->pluck('id')->toArray();

        return $query->where('category_id', $categoryId)
            ->whereNotIn('id', $firstAdIds)
            ->orderByDesc('id')->take(6)->get();
    }
}
