<?php

namespace App\Livewire;

use App\Models\Information;
use App\Models\News;
use App\Models\Proposal;
use App\Models\Reviewer;
use App\Models\Lecturer;
use Livewire\Component;

class ShowHome extends Component
{
    public function render()
    {
        $recentNews = News::latest()->take(3)->get();
        $recentInformation = Information::latest()->take(3)->get();
        $reviewerCount = Reviewer::count();
        $lecturerCount = Lecturer::count();
        $proposalCount = Proposal::count();

        return view('livewire.show-home', [
            'recentNews' => $recentNews,
            'recentInformation' => $recentInformation,
            'reviewerCount' => $reviewerCount,
            'lecturerCount' => $lecturerCount,
            'proposalCount' => $proposalCount
        ]);
    }
}
