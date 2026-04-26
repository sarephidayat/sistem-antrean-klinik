<?php

use App\Livewire\AmbilAntrean;
use Illuminate\Support\Facades\Route;
use App\Livewire\TakeQueue;
use App\Livewire\CallQueue;
use App\Livewire\PanggilAntrean;
use App\Livewire\DisplayAntrean;

Route::get('/display-antrean', DisplayAntrean::class);
Route::get('/ambil-antrean', AmbilAntrean::class);
Route::get('/panggil-antrean', PanggilAntrean::class);

Route::get('/', function () {
    return view('welcome');
});
