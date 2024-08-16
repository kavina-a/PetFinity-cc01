<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['title'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function participants()
    {
        return $this->morphToMany(User::class, 'participant', 'conversation_participants');
    }

    public function otherParticipant($user)
    {
        return $this->participants()->where('participant_id', '!=', $user->id)
            ->where('participant_type', '!=', get_class($user))
            ->first()->participant;
    }
}

