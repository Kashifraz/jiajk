<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\UnionCouncilController;
use App\Http\Controllers\WardController;
use App\Models\Affiliation;
use App\Models\Constituency;
use App\Models\UnionCouncil;

Route::middleware('auth')->group(function () {

    //region routes
    Route::get('region/list', [AffiliationController::class, 'index'])
        ->name('region.list');

    Route::get('region/create', [AffiliationController::class, "create"])
        ->name('affiliation.create');

    Route::delete('affiliation/destroy/{affiliation}', [AffiliationController::class, 'destroy'])
        ->name('affiliation.destroy');

    Route::post('affiliation/update/{affiliation}', [AffiliationController::class, 'update'])
        ->name('affiliation.update');

    Route::delete('constituency/destroy/{constituency}', [ConstituencyController::class, 'destroy'])
        ->name('constituency.destroy');

    Route::post('constituency/update/{constituency}', [ConstituencyController::class, 'update'])
        ->name('constituency.update');

    Route::delete('unioncouncil/destroy/{unionCouncil}', [UnionCouncilController::class, 'destroy'])
        ->name('unioncouncil.destroy');

    Route::post('unioncouncil/update/{unionCouncil}', [UnionCouncilController::class, 'update'])
        ->name('unioncouncil.update');

    Route::delete('ward/destroy/{ward}', [WardController::class, 'destroy'])
        ->name('ward.destroy');

    Route::post('ward/update/{ward}', [WardController::class, 'update'])
        ->name('ward.update');

    Route::post('ward/population/{id}', [WardController::class, 'addPopulation'])
        ->name('ward.population');
});

Route::post('affiliation/store', [AffiliationController::class, "store"])
    ->name('affiliation.store');

Route::post('constituency/store', [ConstituencyController::class, "store"])
    ->name('constituency.store');

Route::post('unioncouncil/store', [UnionCouncilController::class, "store"])
    ->name('unioncouncil.store');

Route::post('ward/store', [WardController::class, "store"])
    ->name('ward.store');


Route::get('getconstituency/{id}', function ($id) {
    $affiliation = Affiliation::find($id);
    $constituencies = $affiliation->constituency;
    return $constituencies;
});

Route::get('getunioncouncil/{id}', function ($id) {
    $constituency = Constituency::find($id);
    $union_councils = $constituency->unioncouncil;
    return $union_councils;
});

Route::get('getward/{id}', function ($id) {
    $unioncouncil = UnionCouncil::find($id);
    $wards = $unioncouncil->ward;
    return $wards;
});
