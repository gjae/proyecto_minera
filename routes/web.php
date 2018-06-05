<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', function(){
	if(Auth::check()){
		return redirect()->to(url('dashboard'));
	}
	return redirect()->to( url('login') );
});

Route::get('excel', function(){


	$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	$sheet->setCellValue('A1', 'Hello World !');

	$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
	return $writer->save('hello world.xlsx');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){

	Route::match(['get', 'post'],'/{modulo?}/{programa?}/{accion?}', 'Dashboard@index');

});
