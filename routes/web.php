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
use Illuminate\Support\Facades\DB;
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

    Route::post('memeber/level/update/{id}', [MembersController::class, 'promoteMember'])
        ->name('member.level.update');

    Route::post('memeber/designation/update/{id}', [MembersController::class, 'updateDesignation'])
        ->name('member.designation.update');

    Route::get('member/export/excel/{destrict?}/{search?}', [MembersController::class, 'exportExcel'])
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

    Route::get("form/show/a/{user?}", [QuestionController::class, "showFormA"])
        ->name("form.show.a");

    Route::get("form/show/b/{user?}", [QuestionController::class, "showFormB"])
        ->name("form.show.b");

    Route::post("form/a/submit/{user?}", [QuestionController::class, "submitFormA"])
        ->name('form.a.submit');

    Route::post("form/b/submit/{user?}", [QuestionController::class, "submitFormB"])
        ->name('form.b.submit');

    Route::get('/backupdb', function () {
            $mysqlHostName      = env('DB_HOST');
            $mysqlUserName      = env('DB_USERNAME');
            $mysqlPassword      = env('DB_PASSWORD');
            $DbName             = env('DB_DATABASE');
            $backup_name        = "mybackup.sql";
            $tables             = array("users","questions","designations",  "affiliations", "constituencies","union_councils", "wards"); 

            $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $get_all_table_query = "SHOW TABLES";
            $statement = $connect->prepare($get_all_table_query);
            $statement->execute();
            $result = $statement->fetchAll();
    
    
            $output = '';
            foreach($tables as $table)
            {
             $show_table_query = "SHOW CREATE TABLE " . $table . "";
             $statement = $connect->prepare($show_table_query);
             $statement->execute();
             $show_table_result = $statement->fetchAll();
    
             foreach($show_table_result as $show_table_row)
             {
              $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
             }
             $select_query = "SELECT * FROM " . $table . "";
             $statement = $connect->prepare($select_query);
             $statement->execute();
             $total_row = $statement->rowCount();
    
             for($count=0; $count<$total_row; $count++)
             {
              $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
              $table_column_array = array_keys($single_result);
              $table_value_array = array_values($single_result);
              $output .= "\nINSERT INTO $table (";
              $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
              $output .= "'" . implode("','", $table_value_array) . "');\n";
             }
            }
            $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
            $file_handle = fopen($file_name, 'w+');
            fwrite($file_handle, $output);
            fclose($file_handle);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file_name));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
               header('Pragma: public');
               header('Content-Length: ' . filesize($file_name));
               ob_clean();
               flush();
               readfile($file_name);
               unlink($file_name);   
    });
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
