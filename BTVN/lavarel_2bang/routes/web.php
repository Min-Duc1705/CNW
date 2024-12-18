<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::get("/",[StudentsController::class,'students'])->name('students');
