<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Advertisement;

class Fraud extends Model
{
    use HasFactory;
    protected $fillable=['reason','message','ad_id','email'];

    public function fraudad()
    {
        return $this->belongsTo(Advertisement::class,'ad_id','id');
    }
   
}
