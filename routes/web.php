<?php

use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnionCouncilController;
use App\Http\Controllers\WardController;
use App\Models\Affiliation;
use App\Models\Constituency;
use App\Models\UnionCouncil;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    $affiliations = Affiliation::latest()->get();

    return view('dashboards.admin', [
        "affiliations" => $affiliations,
    ]);
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/member/dashboard', function () {
    return view('dashboards.member');
})->middleware(['auth', 'verified'])->name('member.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    //member routes
    Route::get('show/member/{id}', [MembersController::class, "show"])
        ->name('member.show');

    Route::get('verify/member/{id}', [MembersController::class, "verify"])
        ->name('member.verify');

    Route::get('edit/member/{id}', [MembersController::class, "edit"])
        ->name('member.edit');

    Route::get('show/members/{destrict?}/{records?}/{search?}', [MembersController::class, "showAllMembers"])
        ->name('members.show');

    Route::post('memeber/role/update/{id}', [MembersController::class, 'updateRole'])
        ->name('member.role.update');

    Route::post('memeber/designation/update/{id}', [MembersController::class, 'updateDesignation'])
        ->name('member.designation.update');

    Route::get('memeber/export/excel', [MembersController::class, 'exportExcel'])
        ->name('member.export.excel');

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

    //designation routes
    Route::get('designation/create', [DesignationController::class, "create"])
        ->name('designation.create');

    Route::post('designation/store', [DesignationController::class, "store"])
        ->name('designation.store');

    Route::delete('designation/destroy/{designation}', [DesignationController::class, 'destroy'])
        ->name('designation.destroy');

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

    Route::get("form/show/a", [QuestionController::class, "showFormA"])
        ->name("form.show.a");

    Route::get("form/show/b", [QuestionController::class, "showFormB"])
        ->name("form.show.b");

    Route::post("form/a/submit", [QuestionController::class, "submitFormA"])
        ->name('form.a.submit');
});

Route::get('/add/members', [MembersController::class, 'addMembers'])
    ->name('members.add');

Route::post('create/member', [MembersController::class, 'create'])->name('member.create');

Route::post('/update/member/{id}', [MembersController::class, 'update'])
    ->name('member.update');

Route::post('affiliation/store', [AffiliationController::class, "store"])
    ->name('affiliation.store');

Route::post('constituency/store', [ConstituencyController::class, "store"])
    ->name('constituency.store');

Route::post('unioncouncil/store', [UnionCouncilController::class, "store"])
    ->name('unioncouncil.store');

Route::post('ward/store', [WardController::class, "store"])
    ->name('ward.store');

Route::get('/stats', function () {
    return view("stats");
})->name('jiajk.stats');

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

require __DIR__ . '/auth.php';
