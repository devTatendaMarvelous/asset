use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssetLogController;

Route::resource('categories', CategoryController::class);
Route::resource('assets', AssetController::class);
Route::resource('assignments', AssignmentController::class);
Route::resource('asset_logs', AssetLogController::class);