<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Image;
use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class AddArticleBanner extends Component
{
    public $addBannerModal;
    public $article_id;
    public $images;
    public $selectedImage;

    public function mount()
    {
        $this->images = Image::all()->toArray();
        $this->article = Article::findOrFail($this->article_id);
    }

    public function addBanner()
    {
        $this->validate([
            'selectedImage' => 'required',
        ]);

        try {
            $this->article->image = $this->selectedImage;
            $this->article->save();
            request()->session()->flash('flash.banner', 'Article successfully updated');
            request()->session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            Log::error($th);
            request()->session()->flash('flash.banner', 'An error occurred while saving your article');
            request()->session()->flash('flash.bannerStyle', 'error');
        }

        return redirect()->route('articles.edit', ['article' => $this->article->id]);
    }

    public function render()
    {
        return view('livewire.gallery.add-article-banner');
    }
}
