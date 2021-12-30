<?php

namespace App\Http\Livewire\Tags;

use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name, $article;

    public function create()
    {
        $this->validate([
            'name' => 'required|unique:tags,name'
        ]);

        try {

            Tag::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);

            request()->session()->flash('flash.banner', 'Tag successfully added');
            request()->session()->flash('flash.bannerStyle', 'success');

            return redirect()->route('articles.edit', ['article' => $this->article]);

        } catch (\Throwable $th) {
            Log::error($th);
            request()->session()->flash('flash.banner', 'An error occurred while adding this tag');
            request()->session()->flash('flash.bannerStyle', 'error');
        }
    }

    public function render()
    {
        return view('livewire.tags.create');
    }
}
