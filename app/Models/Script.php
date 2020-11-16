<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "scripts";

    protected $fillable = ["name", "script_body"];
}
