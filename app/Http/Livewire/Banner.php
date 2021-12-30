<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Banner extends Component
{
    use WithFileUploads;

    public $article_id, $article;
    public $addBannerModal;
    public $image;

    public function mount()
    {
        $this->article = Article::findOrFail($this->article_id);
    }

    public function uploadImage()
    {
        $this->validate([
            'image' => 'required|image|mimes:png,jpg,webp|max:2048|unique:articles,image'
        ]);

        try {

            if ( isset( $this->article->image ) ) {
                Storage::delete(['public/images/'.$this->article->image]);
            }

            $this->image->storeAs('public/images', $this->image->getClientOriginalName());
            $this->article->image = $this->image->getClientOriginalName();
            $this->article->save();
            request()->session()->flash('flash.banner', 'Article successfully updated');
            request()->session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('articles.edit', ['article' => $this->article->id]);

        } catch (\Throwable $th) {

            Log::error($th);
            request()->session()->flash('flash.banner', 'An error occurred while saving your article');
            request()->session()->flash('flash.bannerStyle', 'error');
            return redirect()->route('articles.edit', ['article' => $this->article->id]);
        }
    }

    public function render()
    {
        return view('livewire.banner');
    }
}
