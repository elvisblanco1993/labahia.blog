<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $query = '';
    public $showPosts = 10;

    public function mount()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, "You do not have access to this content.");
        }
    }

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::withTrashed()->where('name', 'like', '%'.$this->query.'%')->paginate($this->showPosts)
        ]);
    }
}
