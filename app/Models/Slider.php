<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "module_slider";

    protected $fillable = ["name", "parent", "description", "link", "sort", "image", "show"];
}
