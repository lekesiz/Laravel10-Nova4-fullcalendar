<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });

Route::middleware(['auth:sanctum', 'nova'])->get('/online-users', function (Request $request) {
    $users = User::where('last_activity', '>', Carbon::now()->subMinutes(10))->get();
    return response()->json($users);
});
