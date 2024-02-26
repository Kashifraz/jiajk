<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;


Route::middleware('auth')->group(function () {

    // form Questions routes 
    Route::get("form/create", [QuestionController::class, "create"])
        ->name("form.create");

    Route::post("form/store", [QuestionController::class, "store"])
        ->name("form.store");

    Route::delete("form/delete/{question}", [QuestionController::class, "destroy"])
        ->name("form.delete");

    Route::get("form/edit/{question}", [QuestionController::class, "edit"])
        ->name("form.edit");

    Route::post("form/update/{question}", [QuestionController::class, "update"])
        ->name("form.update");

    Route::get("form/show/a/{user?}", [QuestionController::class, "showFormA"])
        ->name("form.show.a");

    Route::get("form/show/b/{user?}", [QuestionController::class, "showFormB"])
        ->name("form.show.b");

    Route::post("form/a/submit/{user?}", [QuestionController::class, "submitFormA"])
        ->name('form.a.submit');

    Route::post("form/b/submit/{user?}", [QuestionController::class, "submitFormB"])
        ->name('form.b.submit');

    Route::get("form/approval", [QuestionController::class, "approval"])->name('form.a.approval');
    ROute::get("form/show/{id}", [QuestionController::class, "showForm"])->name('form.show');
    ROute::post("form/updateapprovalpresident/{id}", [QuestionController::class, "updateApprovalPresident"])->name('form.approval.president');
    ROute::post("form/updateapprovalsg/{id}", [QuestionController::class, "updateApprovalSG"])->name('form.approval.sg');
});
