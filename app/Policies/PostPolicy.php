<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Post;

class PostPolicy
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

    public function update(User $user, Post $post)
    {
        return $user->ownsPost($post);
    }

    public function delete(User $user, Post $post)
    {
        return $user->ownsPost($post);
    }

    public function like(User $user, Post $post)
    {
        return !$user->ownsPost($post);
    }
}