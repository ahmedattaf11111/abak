<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $casts = [
        "images" => "json"
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
