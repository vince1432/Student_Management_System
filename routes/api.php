<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware('auth:api')->group(function () {
	Route::apiResource('/teacher', 'Api\TeacherController');
	Route::apiResource('/student', 'Api\StudentController');	
	Route::apiResource('/course', 'Api\CourseController');
	Route::apiResource('/grade', 'Api\GradeController');
	Route::apiResource('/classroom', 'Api\RoomController');
	Route::apiResource('/schedule', 'Api\ScheduleController');
	Route::apiResource('/subject', 'Api\SubjectController');

	Route::post('/logout','Api\LoginController@logout');

});



Route::prefix('/user')->group( function() {
	Route::post('/login','Api\LoginController@login');
});
