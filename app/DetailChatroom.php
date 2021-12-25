<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetailChatroom extends Model
{
    protected $fillable = [
        'user_id','room_id'
    ];
    const UPDATED_AT = null;
    /**
     * Get the chat_room that owns the DetailChatroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatRoom(): BelongsTo
    {
        return $this->belongsTo(Chatroom::class, 'room_id');
    }

    /**
     * Get the user that owns the DetailChatroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}