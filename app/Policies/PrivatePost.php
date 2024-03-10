<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PrivatePost
{
    /**
     * Create a new policy instance.
     */
    public function privatePost(User $user, $post)
    {
        if($post->user_id==Auth::id()) {
            return true;
        }
        return false;
    }

}
