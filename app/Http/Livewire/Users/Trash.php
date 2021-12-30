<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Trash extends Component
{
    public $user;
    public $deleteUser;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function trash()
    {
        try {
            $this->user->update(['status' => 0]);
            $this->user->delete();
            session()->flash('flash.banner', 'The selected user has been successfully deleted!');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('users');
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('flash.banner', 'There was a problem processing your request. Please try again later.');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('users');
        }
    }

    public function render()
    {
        return view('livewire.users.trash');
    }
}
