<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/projekte');

Route::livewire('/projekte', 'pages::projekte.index');

// Deine Routen kommen hierhin.
