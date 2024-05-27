<?php

namespace App\Models;

use App\Commons\Traits\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reqruitment extends Model
{
    use Image;

    protected $guarded=[];
    use HasFactory;
}
