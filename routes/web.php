<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ShowHome;
use App\Livewire\ShowAbout;
use App\Livewire\ShowNews;
use App\Livewire\ShowFaq;
use App\Livewire\ShowContact;
use App\Livewire\ShowInformation;
use App\Livewire\NewsDetail;

Route::get('/', ShowHome::class)->name('home');
Route::get('/tentangsmartp2m', ShowAbout::class)->name('tentang');
Route::get('/berita', ShowNews::class)->name('berita');
Route::get('/berita/{id}', NewsDetail::class)->name('berita.detail');
Route::get('/pengumuman', ShowInformation::class)->name('pengumuman');
Route::get('/faq', ShowFaq::class)->name('faq');
Route::get('/kontak', ShowContact::class)->name('kontak');
