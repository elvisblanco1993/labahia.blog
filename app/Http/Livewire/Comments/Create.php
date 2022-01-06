<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use Livewire\Component;

class Create extends Component
{
    public $article_id, $author, $email, $content;

    public function saveComment()
    {
        $this->validate([
            'author' => 'required',
            'email'  => 'required|email',
            'content' => 'required|min:20|max:255'
        ]);

        try {
            Comment::create([
                'article_id' => $this->article_id,
                'author' => $this->author,
                'email' => $this->email,
                'content' => $this->content,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function render()
    {
        return view('livewire.comments.create');
    }
}
