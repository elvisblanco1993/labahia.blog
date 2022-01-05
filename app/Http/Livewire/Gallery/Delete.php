<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Image;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public $deleteImageModal;
    public $image;

    public function deleteImage()
    {
        $img = Image::find($this->image);
        try {
            Storage::delete('public/images/' . $img->filename);
            $img->delete();
            request()->session()->flash('flash.banner', 'Image successfully deleted.');
            request()->session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            Log::error($th);
            request()->session()->flash('flash.banner', 'An error occurred while deleting this file.');
            request()->session()->flash('flash.bannerStyle', 'error');
        }
        return redirect()->route('gallery');
    }

    public function render()
    {
        return view('livewire.gallery.delete');
    }
}
