<?php

use App\Http\Controllers\MembersController;
use App\Models\Affiliation;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    //member routes
    Route::get('show/member/{id}', [MembersController::class, "show"])
        ->name('member.show');

    Route::get('verify/member/{id}', [MembersController::class, "verify"])
        ->name('member.verify');

    Route::get('edit/member/{id}', [MembersController::class, "edit"])
        ->name('member.edit');

    Route::get('show/members/{destrict?}/{level?}/{records?}/{search?}', [MembersController::class, "showAllMembers"])
        ->name('members.show');

    Route::post('memeber/role/update/{id}', [MembersController::class, 'updateRole'])
        ->name('member.role.update');

    Route::post('memeber/level/update/{id}', [MembersController::class, 'promoteMember'])
        ->name('member.level.update');

    Route::post('memeber/designation/update/{id}', [MembersController::class, 'updateDesignation'])
        ->name('member.designation.update');

    Route::get('member/export/excel/{destrict?}/{search?}', [MembersController::class, 'exportExcel'])
        ->name('member.export.excel');
});

Route::get('/add/members', [MembersController::class, 'addMembers'])
    ->name('members.add');

Route::post('create/member', [MembersController::class, 'create'])->name('member.create');

Route::post('/update/member/{id}', [MembersController::class, 'update'])
    ->name('member.update');