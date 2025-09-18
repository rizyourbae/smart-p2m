<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;


class NewsDetail extends Component
{
    public $news;

    public $selectedCategory = null;

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function mount($id)
    {
        $this->news = News::findOrFail($id);
    }

    public function render()
    {

        $newsQuery = News::latest();
        if ($this->selectedCategory) {
            $newsQuery->where('category', $this->selectedCategory);
        }

        $categories = News::select('category')->distinct()->pluck('category');
        $recentPosts = News::latest()->take(5)->get();

        return view('livewire.news-detail', [
            'news' => $this->news,
            'categories'=> $categories,
            'recentPosts' => $recentPosts
        ]);
    }
}
