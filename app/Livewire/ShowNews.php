<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class ShowNews extends Component
{
    public $selectedCategory = null;

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
    }

    use WithPagination;

    public function render()
    {
        $newsQuery = News::latest();
        if ($this->selectedCategory) {
            $newsQuery->where('category', $this->selectedCategory);
        }
        $news = $newsQuery->paginate(3);

        $categories = News::select('category')->distinct()->pluck('category');
        $recentPosts = News::latest()->take(5)->get(); // Ambil 5 berita terbaru

        return view('livewire.show-news', [
            'news' => $news,
            'categories' => $categories,
            'selectedCategory' => $this->selectedCategory,
            'recentPosts' => $recentPosts
        ]);
    }
}
