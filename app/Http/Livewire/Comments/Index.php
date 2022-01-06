<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use Livewire\Component;

class Index extends Component
{
    public $comments, $article_id;

    public function mount()
    {
        $this->comments = Comment::where('article_id', $this->article_id)->get();
    }

    public function render()
    {
        return view('livewire.comments.index');
    }
}
