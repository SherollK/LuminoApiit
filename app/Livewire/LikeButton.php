<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButton extends Component
{

    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function toggleLike()
    {
        if (auth()->guest()) {
            return $this->redirect(route('login'), true);
        }

        if (!auth()->user()->hasVerifiedEmail()) {
            return $this->redirectRoute('verification.notice'); // Use route name for verification
        }

        $user = auth()->user()->hasVerifiedEmail();

        if ($user->hasLiked($this->post)) {
            $user->likes()->detach($this->post);
            return;
        }

        $user->likes()->attach($this->post);
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
