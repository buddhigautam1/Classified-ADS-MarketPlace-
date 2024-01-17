<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Advertisement;

class Message extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $appends=['selfOwned'];

    public function getSelfOwnedAttribute()
    {
        return $this->user_id === auth()->user()->id;
    }

    public function sender(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ads()
    {
        return $this->belongsTo(Advertisement::class,'ad_id','id');
    }

 

  
}
