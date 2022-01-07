<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use Livewire\Component;

class Delete extends Component
{
    public $comment_id;

    public function delete()
    {
        Comment::find($this->comment_id)->delete();
        return redirect(route('comments'));
    }

    public function render()
    {
        return view('livewire.comments.delete');
    }
}
