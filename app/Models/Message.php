<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "message";

    protected $fillable = ["subject", "message", "phone", "email", "type"];

    /**
     * get message type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function messageType()
    {
        return $this->belongsTo(MessageType::class, 'type');
    }



}
