<?php

namespace App\Http\Livewire\Articles;

use App\Models\Tag;
use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    public $article, $title, $body, $image;
    public $addTagsModal, $addBannerModal;
    public $wordCount;
    public $tags;
    public $selectedTags = [];
    public $activeTags;
    public $availableTags;
    public $preview = false;

    public function mount()
    {
        $this->article = Article::findOrFail(request()->article);
        $this->title = $this->article->title;
        $this->body = $this->article->body;
        $this->image = $this->article->image;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        try {

            $this->article->update([
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'body' => $this->body,
                'image' => $this->image,
            ]);

            return redirect()->route('articles.edit', ['article' => $this->article->id]);

        } catch (\Throwable $th) {
            Log::error($th);
            request()->session()->flash('flash.banner', 'An error occurred while saving your article');
            request()->session()->flash('flash.bannerStyle', 'error');
            return redirect()->route('articles.edit', ['article' => $this->article->id]);
        }
    }

    public function attachTag($tag)
    {
        try {
            $this->article->tags()->attach($tag);
        } catch (\Throwable $th) {
            throw $th;
        }
        $this->activeTags->fresh();
    }

    public function detachTag($tag)
    {
        try {
            $this->article->tags()->detach($tag);
        } catch (\Throwable $th) {
            throw $th;
        }
        $this->activeTags->fresh();
    }

    public function setComments()
    {
        $this->article->comments = ($this->article->comments === 1) ? 0 : 1;
        $this->article->save();
    }

    public function render()
    {
        $this->availableTags = Tag::whereDoesntHave('articles', function($query){ $query->where('article_id', $this->article->id); })->get();
        $this->activeTags = Tag::whereHas('articles', function($query){ $query->where('article_id', $this->article->id); })->get();

        $this->wordCount = str_word_count(strip_tags($this->body), 0);
        return view('livewire.articles.edit');
    }
}
