<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraud extends Model
{
    use HasFactory;

    protected $fillable = ['reason', 'message', 'ad_id', 'email'];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'ad_id', 'id');
    }

    public function fraudad()
    {
        return $this->advertisement();
    }
}
