<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "module_review";

    protected $fillable = ["name", "parent", "review", "link", "sort", "image", "show"];
}
