<?php

use App\Http\Controllers\FormBController;
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

    Route::get("form/show/b/{user?}", [FormBController::class, "showFormB"])
        ->name("form.show.b");

    Route::post("form/a/submit/{user?}", [QuestionController::class, "submitFormA"])
        ->name('form.a.submit');

    Route::post("form/b/submit/{user?}", [FormBController::class, "submitFormB"])
        ->name('form.b.submit');

    Route::get("form/a/approval", [QuestionController::class, "approvalFormA"])
        ->name('form.a.approval');

    Route::get("form/b/approval", [FormBController::class, "approvalFormB"])
        ->name('form.b.approval');

    Route::get("form/a/show/{id}", [QuestionController::class, "showFormADetails"])
        ->name('form.a.show');

    Route::get("form/b/show/{id}", [FormBController::class, "showFormBDetails"])
        ->name('form.b.show');

    Route::post("form/a/updateapprovaldpd/{id}", [QuestionController::class, "updateApprovalDPD"])
        ->name('form.approval.dpd');

    Route::post("form/a/updateapprovalsg/{id}", [QuestionController::class, "updateApprovalSG"])
        ->name('form.approval.sg');

    Route::post("form/b/updateapprovaldpd/{id}", [FormBController::class, "updateApprovalDPD"])
        ->name('form.b.approval.dpd');

    Route::post("form/b/updateapprovalsg/{id}", [FormBController::class, "updateApprovalSG"])
        ->name('form.b.approval.sg');

    Route::post("form/b/updateapprovalpd/{id}", [FormBController::class, "updateApprovalDP"])
        ->name('form.b.approval.dp');
});
