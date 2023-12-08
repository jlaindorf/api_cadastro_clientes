<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psr\Http\Client\ClientInterface;

Route::post('clients', [ClientController::class, 'store']);

