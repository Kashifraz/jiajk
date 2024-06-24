<?php

use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnionCouncilController;
use App\Models\Affiliation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Backup\BackupDestination\BackupDestinationFactory;
use Spatie\Backup\BackupDestination\BackupDestinationStatus;
use Spatie\Backup\Events\BackupWasSuccessful;
use Spatie\Backup\Tasks\Backup\BackupJob;

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
})->middleware(['auth', 'verified', 'role:admin']);

Route::get('/member/dashboard', function () {
    return view('dashboards.member');
})->name('member.dashboard');
// ->middleware([\Spatie\Permission\Middleware\RoleMiddleware::using(['member'])])
Route::get('/admin/dashboard', function () {

    $affiliations = Affiliation::orderByRaw("FIELD(region, 'ajk', 'gb', 'pk')")
        ->get()
        ->groupBy('region');
    
    $entries = array();
    $records = DB::table('users')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->groupBy('date')
        ->get();
    foreach ($records as $record) {
        $entries[] = array(
            "title" => $record->count . " members added",
            "start" => $record->date,
            "backgroundColor" => 'green',
            "borderColor" => 'green'
        );
    }

    return view('dashboards.admin', [
        "affiliations" => $affiliations,
        "entries" => $entries
    ]);
})->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    //designation routes
    Route::get('designation/create', [DesignationController::class, "create"])
        ->name('designation.create');

    Route::post('designation/store', [DesignationController::class, "store"])
        ->name('designation.store');

    Route::delete('designation/destroy/{designation}', [DesignationController::class, 'destroy'])
        ->name('designation.destroy');
});

Route::get('/backupdb', function () {
    $mysqlHostName      = env('DB_HOST');
    $mysqlUserName      = env('DB_USERNAME');
    $mysqlPassword      = env('DB_PASSWORD');
    $DbName             = env('DB_DATABASE');
    $backup_name        = "mybackup.sql";
    $tables             = array("users", "questions", "designations",  "affiliations", "constituencies", "union_councils", "wards");

    $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword", array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $get_all_table_query = "SHOW TABLES";
    $statement = $connect->prepare($get_all_table_query);
    $statement->execute();
    $result = $statement->fetchAll();


    $output = '';
    foreach ($tables as $table) {
        $show_table_query = "SHOW CREATE TABLE " . $table . "";
        $statement = $connect->prepare($show_table_query);
        $statement->execute();
        $show_table_result = $statement->fetchAll();

        //  foreach($show_table_result as $show_table_row)
        //  {
        //   $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
        //  }
        $select_query = "SELECT * FROM " . $table . "";
        $statement = $connect->prepare($select_query);
        $statement->execute();
        $total_row = $statement->rowCount();

        for ($count = 0; $count < $total_row; $count++) {
            $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
            $table_column_array = array_keys($single_result);
            $table_value_array = array_values($single_result);
            $output .= '\nINSERT INTO $table (';
            $output .= '' . implode(", ", $table_column_array) . ') VALUES (';
            $output .= '\"' . implode('","', $table_value_array) . "\');\n";
        }
    }
    return json_encode($output);
});

Route::get('/stats', function () {
    return view("stats");
})->name('jiajk.stats');

Route::get('/destrict/show/{id}', [AffiliationController::class, "show"])
    ->name('affiliation.show');

Route::get('/constituency/show/{id}', [ConstituencyController::class, "show"])
    ->name('constituency.show');

Route::get('/unioncouncil/show/{id}', [UnionCouncilController::class, "show"])
    ->name('unioncouncil.show');

require __DIR__ . '/member.php';
require __DIR__ . '/region.php';
require __DIR__ . '/questions.php';
require __DIR__ . '/auth.php';
