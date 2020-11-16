<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cta extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "module_cta";

    protected $fillable = ["name", "parent", "description", "link", "image", "show"];
}
