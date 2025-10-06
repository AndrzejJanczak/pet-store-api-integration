<?php

use App\Http\Controllers\LangController;
use App\Http\Controllers\Pet;
use Illuminate\Support\Facades\Route;

//--------LANGUAGE SET----------
//Route::get('/lang/{locale}', function ($locale) {
//    if (!in_array($locale, ['pl', 'en'])) {
//        abort(400);
//    }
//
//    session(['locale' => $locale]);
//    app()->setLocale($locale);
//    return to_route('index');
//})->name('lang.switch');


Route::get('/lang/{langIso}', [LangController::class, 'switchLanguage'])->name('lang.switch');

//------END LANGUAGE SET--------



//------------PETS---------------
Route::get('/', [Pet::class, 'index'])->name('index');

Route::post('/get-pet', function () {
    return new Pet('get-')->getPet(request());
})->name('get-pet');

Route::post('/delete-pet', function () {
    return new Pet('delete-')->deletePet(request());
})->name('delete-pet');

Route::post('/', function () {
    return new Pet('add-')->createPet(request());
});

Route::patch('/', function () {
    return new Pet('edit-')->updatePet(request());
});
//----------END PETS-------------
