<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Topic;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Topic $topic)
    {
        return $user->ownsTopic($topic);
    }

    public function delete(User $user, Topic $topic)
    {
        return $user->ownsTopic($topic);
    }
}