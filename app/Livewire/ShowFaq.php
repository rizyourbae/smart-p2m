<?php

namespace App\Livewire;
use App\Models\Faq;
use Livewire\Component;

class ShowFaq extends Component
{
    public function render()
    {
        $faqs = Faq::all();

        return view('livewire.show-faq', [
            'faqs' => $faqs
        ]);
    }
}
