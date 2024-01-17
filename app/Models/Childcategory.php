<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
class Childcategory extends Model
{
    use HasFactory;
    protected $fillable= ['name','subcategory_id','slug'];
    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
       //new added
   public function ads()
   {
       return $this->hasMany(Advertisement::class);
   }


   
}
