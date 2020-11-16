<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingType extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "setting_type";

    protected $fillable = ["name", "description", "show"];
}
