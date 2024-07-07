<?php

use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\UnionCouncilController;
use App\Http\Controllers\WardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/districts', [AffiliationController::class, 'getDistricts']);
Route::get('/district/{affiliation}/constituencies', [ConstituencyController::class, 'getConstituencies']);
Route::get('/constituency/{constituency}/unioncouncils', [UnionCouncilController::class, 'getUnionCouncils']);
Route::get('/unioncouncil/{unioncouncil}/wards', [WardController::class, 'getWards']);
Route::post('/member/store', [MembersController::class, 'createMemberAPI']);
