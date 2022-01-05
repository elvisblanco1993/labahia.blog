<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Image;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $uploadModal;
    public $images = [];

    public function save()
    {

        $this->validate([
            'images.*' => 'image|max:1024', // 1MB Max
        ]);

        if ( ! empty($this->images) ) {

            try {
                foreach ($this->images as $image) {
                    $image->storeAs('public/images', $image->getClientOriginalName());
                    Image::create([
                        'filename' => $image->getClientOriginalName()
                    ]);
                }
                request()->session()->flash('flash.banner', 'All images were successfully uploaded.');
                request()->session()->flash('flash.bannerStyle', 'success');
            } catch (\Throwable $th) {
                Log::error($th);
                request()->session()->flash('flash.banner', 'An error occurred while uploading some of your images');
                request()->session()->flash('flash.bannerStyle', 'error');
            }
        } else {
            request()->session()->flash('flash.banner', 'No images to upload. No action was taken.');
            request()->session()->flash('flash.bannerStyle', 'info');
        }

        return redirect()->route('gallery');
    }

    public function render()
    {
        return view('livewire.gallery.upload');
    }
}
