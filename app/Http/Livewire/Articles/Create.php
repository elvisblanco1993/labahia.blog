<?php

namespace App\Http\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $title, $body, $image;
    public $addTagsModal, $addBannerModal;

    public $wordCount;

    public function create()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        try {

            $article = Article::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->user()->id,
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'body' => $this->body,
                'image' => $this->image,
            ]);

            return redirect()->route('articles.edit', ['article' => $article->id]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function render()
    {
        $this->wordCount = str_word_count(strip_tags($this->body), 0);

        return view('livewire.articles.create');
    }
}
