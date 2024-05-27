<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ["services_ids"];
    public function services()
    {
        return $this->belongsToMany(Service::class, CategoryService::class, "category_id", "service_id");
    }
}
