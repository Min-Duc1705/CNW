<?php

use App\Http\Controllers\MedicinesController;
use Illuminate\Support\Facades\Route;


Route::get('/', MedicinesController::class .'@index')->name('medicines.index');
