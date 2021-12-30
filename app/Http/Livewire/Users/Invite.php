<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Mail\EmailInvitation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Invite extends Component
{
    public $inviteUserModal;
    public $name, $email, $role;

    public function mount()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, "You do not have access to this content.");
        }
    }

    public function invite()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|in:admin,user'
        ]);

        $password = Str::random(8);

        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($password),
                'role' => $this->role,
                'status' => 0,
            ]);

            Mail::to($this->email)->send(new EmailInvitation($this->name, $this->email, $password));
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.users.invite');
    }
}
