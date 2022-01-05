<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.gallery.index', [
            'images' => Image::paginate(24)
        ]);
    }
}
