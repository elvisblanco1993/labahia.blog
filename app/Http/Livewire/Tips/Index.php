<?php

namespace App\Http\Livewire\Tips;

use App\Models\Tip;
use Livewire\Component;

class Index extends Component
{
    public $tips;

    public function render()
    {
        $this->tips = Tip::all();
        return view('livewire.tips.index');
    }
}
