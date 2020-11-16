<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infography extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "module_infography";

    protected $fillable = ["name", "parent", "description", "link", "sort", "icon", "show"];
}
