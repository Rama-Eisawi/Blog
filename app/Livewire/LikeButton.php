<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButton extends Component
{

    //to update the page without reload
    #[Reactive]
    public Post $post;

    public function toggleLike()
    {
        //like or unlike
        if (auth()->guest()) {
            return $this->redirect(route('login'), true);//navigate: true
        }
        $user=auth()->user();

        if($user->hasLiked($this->post))
        {
            $user->likes()->detach($this->post->id);
            return; //remove the like of the user from this post
        }
        $user->likes()->attach($this->post);
    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
