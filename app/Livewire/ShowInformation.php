<?php

namespace App\Livewire;

use App\Models\Information;
use Livewire\Component;
use Livewire\WithPagination;

class ShowInformation extends Component
{
    use WithPagination;
    public function render()
    {
        $information = Information::query()
            ->latest()
            ->paginate(3);

        $recentPosts = Information::latest()->take(5)->get();

        return view('livewire.show-information', [
            'information' => $information,
            'recentPosts' => $recentPosts
        ]);
    }
}
