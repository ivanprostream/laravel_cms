<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "page";

    protected $fillable = ["name", "url", "path", "short_text", "text", "text_2", "image", "show", "title", "description", "key_words", "sort", "type", "menu", "script"];

    /**
     * get page type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pageType()
    {
        return $this->belongsTo(PageType::class, 'type');
    }

}
