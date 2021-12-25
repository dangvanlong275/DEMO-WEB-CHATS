<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Chatroom extends Model
{
    protected $fillable = [
        'name','type','creator'
    ];

    const ROOM_TYPE = [
        'private' => 'private',
        'group' => 'group_chat'
    ];

    /**
     * Get all of the members for the Chatroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function members(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, DetailChatroom::class,
                                        'room_id',
                                        'id',
                                        'id',
                                        'user_id'
                                    );
    }
}
