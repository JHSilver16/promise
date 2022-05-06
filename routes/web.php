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

Route::get('/', function () {
    return redirect(route('login'));
});
Route::get('/print', function () {
    return view('reports.orsprint');
});
Route::get('/403', function () {
    return view('inc.403');
})->name('403');


Auth::routes();

Route::group(['middleware' => ['auth', 'admin']], function() {
    // your routes
  
});
Route::group(['middleware' => ['web']], function () {
 Route::get('/prs', 'OperationsController@prs')->name('prs')->middleware('auth');
   Route::get('/rfqs', 'OperationsController@rfqs')->name('rfqs')->middleware('auth');
   Route::get('/abstracts', 'OperationsController@abstracts')->name('abstracts')->middleware('auth');
   Route::get('/ris', 'OperationsController@ris')->name('ris')->middleware('auth');
   Route::get('/pos', 'OperationsController@pos')->name('pos')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/categories', 'LibraryController@categories')->name('categories')->middleware('auth');
Route::post('/addcategory', 'LibraryController@addcategory')->name('addcategory')->middleware('auth');
Route::get('/suppliers', 'LibraryController@suppliers')->name('suppliers')->middleware('auth');
Route::post('/addsupplier', 'LibraryController@addsupplier')->name('addsupplier')->middleware('auth');
Route::get('/units', 'LibraryController@units')->name('units')->middleware('auth');
Route::post('/addunit', 'LibraryController@addunit')->name('addunit')->middleware('auth');
Route::get('/updateinv', 'LibraryController@updateinv')->name('updateinv')->middleware('auth');
Route::post('/setinv', 'LibraryController@setinv')->name('setinv')->middleware('auth');

Route::get('/getnotiff', 'LibraryController@getnotiff')->name('getnotiff')->middleware('auth');

Route::get('/getemployees', 'UserController@getemployees')->name('getemployees')->middleware('auth');
Route::get('/users', 'UserController@users')->name('users')->middleware('auth');
Route::post('/setuser', 'UserController@setuser')->name('setuser')->middleware('auth');

Route::get('/additem', 'LibraryController@additem')->name('additem')->middleware('auth');
Route::get('/items', 'LibraryController@items')->name('items')->middleware('auth');
Route::get('/inventoryview', 'LibraryController@inventoryview')->name('inventoryview')->middleware('auth');
Route::post('/submititem', 'LibraryController@submititem')->name('submititem')->middleware('auth');
Route::get('/edititem/{id}', 'LibraryController@edititem')->name('edititem')->middleware('auth');
Route::get('/dashboard', 'LibraryController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/addpr', 'OperationsController@addpr')->name('addpr')->middleware('auth');
Route::get('/editpr/{id}', 'OperationsController@editpr')->name('editpr')->middleware('auth');
Route::post('/submitpr', 'OperationsController@submitpr')->name('submitpr')->middleware('auth');
Route::post('/submitrfq', 'OperationsController@submitrfq')->name('submitrfq')->middleware('auth');

Route::get('/getprlines', 'OperationsController@getprlines')->name('getprlines')->middleware('auth');
Route::get('/updatepr/{id}/{status}/{type}/{remarks}', 'OperationsController@updatepr')->name('updatepr')->middleware('auth');

Route::get('/getrfqs', 'OperationsController@getrfqs')->name('getrfqs')->middleware('auth');
Route::get('/editrfq/{id}', 'OperationsController@editrfq')->name('editrfq')->middleware('auth');
Route::get('/getsuppliers', 'OperationsController@getsuppliers')->name('getsuppliers')->middleware('auth');
Route::post('/updaterfqline', 'OperationsController@updaterfqline')->name('updaterfqline')->middleware('auth');
Route::get('/getrfqlines', 'OperationsController@getrfqlines')->name('getrfqlines')->middleware('auth');

Route::get('/kanbanboard', 'OperationsController@kanban')->name('kanbanboard')->middleware('auth');
Route::post('/searchkanban', 'OperationsController@searchkanban')->name('searchkanban')->middleware('auth');

Route::post('/submitabstract', 'OperationsController@submitabstract')->name('submitabstract')->middleware('auth');
Route::get('/editabstract/{id}', 'OperationsController@editabstract')->name('editabstract')->middleware('auth');
Route::get('/getpolines', 'OperationsController@getpolines')->name('getpolines')->middleware('auth');
Route::post('/submitpo', 'OperationsController@submitpo')->name('submitpo')->middleware('auth');
Route::post('/setors', 'OperationsController@setors')->name('setors')->middleware('auth');

Route::get('/getpolist', 'OperationsController@getpolist')->name('getpolist')->middleware('auth');
Route::get('/createpos', 'OperationsController@createpos')->name('createpos')->middleware('auth');
Route::post('/submitacc', 'OperationsController@submitacc')->name('submitacc')->middleware('auth');
Route::post('/editpo', 'OperationsController@editpo')->name('editpo')->middleware('auth');

Route::get('/editiar', 'OperationsController@editiar')->name('editiar')->middleware('auth');

Route::post('/stockin', 'OperationsController@stockin')->name('stockin')->middleware('auth');
Route::get('/addris', 'OperationsController@addris')->name('addris')->middleware('auth');
Route::post('/submitris', 'OperationsController@submitris')->name('submitris')->middleware('auth');
Route::post('/updaterline', 'OperationsController@updaterline')->name('updaterline')->middleware('auth');
Route::post('/updateprlist', 'OperationsController@updateprlist')->name('updateprlist')->middleware('auth');
Route::post('/updateitems', 'OperationsController@updateitems')->name('updateitems')->middleware('auth');

Route::get('/getrislines', 'OperationsController@getrislines')->name('getrislines')->middleware('auth');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout')->middleware('auth');

Route::get('/itemlist', 'ReportController@itemlist')->name('itemlist')->middleware('auth');
Route::get('/barcodelist', 'ReportController@barcodelist')->name('barcodelist')->middleware('auth');
Route::get('/pr/{id}', 'ReportController@pr')->name('pr')->middleware('auth');
Route::get('/rfq/{id}', 'ReportController@rfq')->name('rfq')->middleware('auth');
Route::get('/abstract/{id}', 'ReportController@abstracts')->name('abstract')->middleware('auth');
Route::get('/posreport/{id}', 'ReportController@po')->name('posreport')->middleware('auth');

Route::get('/iar/{id}', 'ReportController@iar')->name('iar')->middleware('auth');
Route::get('/risreport/{id}', 'ReportController@ris')->name('risreport')->middleware('auth');
Route::get('/orsreport/{id}', 'ReportController@ors')->name('orsreport')->middleware('auth');
Route::get('/stockcard/{id}', 'ReportController@stockcard')->name('stockcard')->middleware('auth');
Route::get('/reportview', 'ReportController@reportview')->name('reportview')->middleware('auth');
Route::get('/issuedreport', 'ReportController@issuedreport')->name('issuedreport')->middleware('auth');
Route::get('/inventory', 'ReportController@inventory')->name('inventory');
Route::get('/pmr', 'ReportController@pmr')->name('pmr')->middleware('auth');
Route::get('/acclist', 'ReportController@acclist')->name('acclist')->middleware('auth');
Route::get('/formlist', 'ReportController@formlist')->name('formlist')->middleware('auth');


Route::get('/addrisstaff', 'StaffController@addris')->name('addrisstaff')->middleware('auth');
Route::post('/submitrisstaff', 'StaffController@submitris')->name('submitrisstaff')->middleware('auth');
Route::get('/risstaff', 'StaffController@ris')->name('risstaff')->middleware('auth');
Route::get('/itemreqs', 'StaffController@items')->name('itemreqs')->middleware('auth');
Route::get('/addprstaff', 'StaffController@addpr')->name('addprstaff')->middleware('auth');
Route::get('/itemliststaff', 'StaffController@itemlist')->name('itemliststaff')->middleware('auth');
Route::get('/editprstaff/{id}', 'StaffController@editpr')->name('editprstaff')->middleware('auth');
Route::get('/prsstaff', 'StaffController@prs')->name('prsstaff')->middleware('auth');
Route::post('/requestitem', 'StaffController@requestitem')->name('requestitem')->middleware('auth');
});
