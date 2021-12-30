<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Restore extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function restore()
    {
        try {
            $this->user->update(['status' => 1]);
            $this->user->restore();
            session()->flash('flash.banner', 'The selected user has been successfully restored!');
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
        return view('livewire.users.restore');
    }
}
