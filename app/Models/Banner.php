<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "module_banner";

    protected $fillable = ["name", "parent", "link", "image", "show"];
}
