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

Route::group(['middleware' => ['auth:api','permited'],'namespace'=>'Api'], function () {
	Route::get('/user', function (Request $request) {
    	return $request->user(); // Info del usuario logueado
	});

	/** RUTAS MATASISTENCIA **/
	Route::group(['prefix'=>'matasistencia','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','MatasistenciasCrl@index');
		Route::post('/','MatasistenciasCrl@store');
		Route::get('/{id}','MatasistenciasCrl@show');
		Route::put('/{id}','MatasistenciasCrl@update');
		Route::delete('/{id}','MatasistenciasCrl@destroy');
		//Adicionales
		Route::get('/search/{info}','MatasistenciasCrl@search');
		Route::get('/range/{ini}','MatasistenciasCrl@index');
		Route::get('/count/elem','MatasistenciasCrl@count');
	});

	/** RUTAS NEWASISTENCIA **/
	Route::group(['prefix'=>'newasistencia','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','NewasistenciasCrl@index');
		Route::post('/','NewasistenciasCrl@store');
		Route::get('/{id}','NewasistenciasCrl@show');
		Route::put('/{id}','NewasistenciasCrl@update');
		Route::delete('/{id}','NewasistenciasCrl@destroy');
		//Adicionales
		Route::get('/search/{info}','NewasistenciasCrl@search');
		Route::get('/range/{ini}','NewasistenciasCrl@index');
		Route::get('/count/elem','NewasistenciasCrl@count');
	});

	/** RUTAS ALUMNOS **/
	Route::group(['prefix'=>'alumnos','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','AlumnosCtrl@index');
		Route::post('/','AlumnosCtrl@store');
		Route::get('/{id}','AlumnosCtrl@show');
		Route::put('/{id}','AlumnosCtrl@update');
		Route::delete('/{id}','AlumnosCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','AlumnosCtrl@search');
	});
	
	/** RUTAS PROFESOR **/
	Route::group(['prefix'=>'profesor','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','ProfesorCtrl@index');
		Route::post('/','ProfesorCtrl@store');
		Route::get('/{id}','ProfesorCtrl@show');
		Route::put('/{id}','ProfesorCtrl@update');
		Route::delete('/{id}','ProfesorCtrl@destroy');
		//Adicionales
	});

	/** RUTAS MATERIAS HAS PERIODOS TABLE **/
	Route::group(['prefix'=>'materiashasperiodos','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','MateriasHasPeriodosCtrl@index');
		Route::post('/','MateriasHasPeriodosCtrl@store');
		Route::get('/{id}','MateriasHasPeriodosCtrl@show');
		Route::put('/{id}','MateriasHasPeriodosCtrl@update');
		Route::delete('/{id}','MateriasHasPeriodosCtrl@destroy');
		//Adicionales
	});

	/** RUTAS MATERIAS HAS NIVELES TABLE **/
	Route::group(['prefix'=>'materiashasniveles','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','MateriasHasNivelesCtrl@index');
		Route::post('/','MateriasHasNivelesCtrl@store');
		Route::get('/{id}','MateriasHasNivelesCtrl@show');
		Route::put('/{id}','MateriasHasNivelesCtrl@update');
		Route::delete('/{id}','MateriasHasNivelesCtrl@destroy');
		//Adicionales
	});

	/** RUTAS NIVELES HAS ANIOS TABLE **/
	Route::group(['prefix'=>'niveleshasanios','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','NivelesHasAniosCtrl@index');
		Route::post('/','NivelesHasAniosCtrl@store');
		Route::get('/{id}','NivelesHasAniosCtrl@show');
		Route::put('/{id}','NivelesHasAniosCtrl@update');
		Route::delete('/{id}','NivelesHasAniosCtrl@destroy');
		//Adicionales
		Route::get('add/nivelables','NivelesHasAniosCtrl@nivelables');
	});

	/** RUTAS PERIODOS TABLE **/
	Route::group(['prefix'=>'periodos','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','PeriodosCtrl@index');
		Route::post('/','PeriodosCtrl@store');
		Route::get('/{id}','PeriodosCtrl@show');
		Route::put('/{id}','PeriodosCtrl@update');
		Route::delete('/{id}','PeriodosCtrl@destroy');
		//Adicionales
	});

	/** RUTAS NIVELES TABLE **/
	Route::group(['prefix'=>'niveles','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','NivelesCtrl@index');
		Route::post('/','NivelesCtrl@store');
		Route::get('/{id}','NivelesCtrl@show');
		Route::put('/{id}','NivelesCtrl@update');
		Route::delete('/{id}','NivelesCtrl@destroy');
		//Adicionales
	});

	/** RUTAS MATERIAS TABLE **/
	Route::group(['prefix'=>'materias','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','MateriasCtrl@index');
		Route::post('/','MateriasCtrl@store');
		Route::get('/{id}','MateriasCtrl@show');
		Route::put('/{id}','MateriasCtrl@update');
		Route::delete('/{id}','MateriasCtrl@destroy');
		//Adicionales
	});

	/** RUTAS ANIOS TABLE **/
	Route::group(['prefix'=>'anios','middleware'=>'coordinador'],function(){
		//Basicos
		Route::get('/','AniosCtrl@index');
		Route::post('/','AniosCtrl@store');
		Route::get('/{id}','AniosCtrl@show');
		Route::put('/{id}','AniosCtrl@update');
		Route::delete('/{id}','AniosCtrl@destroy');
		//Adicionales
	});

	/** RUTAS EMPLEADOS TABLE **/
	Route::group(['prefix'=>'empleados','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','EmpleadosCtrl@index');
		Route::post('/','EmpleadosCtrl@store');
		Route::get('/{id}','EmpleadosCtrl@show');
		Route::put('/{id}','EmpleadosCtrl@update');
		Route::delete('/{id}','EmpleadosCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','EmpleadosCtrl@search');
		Route::get('/range/{ini}','EmpleadosCtrl@index');
	});

	/** RUTAS GENERALES TABLE **/
	Route::group(['prefix'=>'generales','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','GenCtrl@index');
		Route::post('/','GenCtrl@store');
		Route::get('/{id}','GenCtrl@show');
		Route::put('/{id}','GenCtrl@update');
		Route::delete('/{id}','GenCtrl@destroy');
		//Adicionales
	});

	/** RUTAS USERS TABLE **/
	Route::group(['prefix'=>'users','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','UserCtrl@index');
		Route::post('/','UserCtrl@store');
		Route::get('/{user}','UserCtrl@show');
		Route::put('/{user}','UserCtrl@update');
		Route::delete('/{user}','UserCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','UserCtrl@search');
		Route::get('/range/{ini}','UserCtrl@index');
		Route::put('/status/{user}/{status}','UserCtrl@modEstado');
		Route::get('/add/empleables','UserCtrl@userEmpleable');
		Route::get('/add/alumnable','UserCtrl@userAlumnable');
	});

	/** RUTAS PERFIL TABLE **/
	Route::group(['prefix'=>'perfil'],function(){
		//Basicos
		Route::get('/','PerfilCtrl@show');
		Route::put('/','PerfilCtrl@update');
		//Adicionales
	});

	/** RUTAS TIPO_USUARIO TABLE **/
	Route::group(['prefix'=>'tipo','middleware'=>'admin'],function(){
		Route::post('/','TipoCtrl@store');
		Route::put('/{id}','TipoCtrl@update');
		Route::delete('/{id}','TipoCtrl@destroy');
		Route::get('/','TipoCtrl@index');
		Route::get('/{id}','TipoCtrl@show');
	});
});
