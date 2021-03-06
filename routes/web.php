<?php
use App\Company;

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
	// Socialite
	Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
	Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/search', 'ShipmentController@search')->name('search');
Route::get('/algoria', function () {
	return view('search');
});
Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('/verify/{verifyToken}', 'EmailController@verify')->name('verify');

Route::get('/map', function () {
	return view('csv.map');
});

Route::get('/', function () {
	return view('view');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::get('/courier/{name}', function () {
		return redirect('/');
	})->where('name', '[A-Za-z]+');

	Route::get('/courier', function () {
	    $companies = Company::where('id', Auth::user()->company_id)->get();
	    foreach ($companies as $company) {
	        $company_logo = $company->logo;
	    }
		$newrole = Auth::user()->roles;
		foreach ($newrole as $name) {
			$rolename = $name->name;
		}
		return view('welcome', compact('rolename', 'company_logo'));
	});

	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('users', 'UserController');
	Route::resource('roles', 'RoleController');
	Route::resource('shipment', 'ShipmentController');
	Route::resource('product', 'ProductController');
	Route::resource('shipreports', 'ReportController');
	Route::resource('container', 'ContainerController');
	Route::resource('branches', 'BranchController');
	Route::resource('companies', 'CompanyController');
	Route::resource('email', 'EmailController');
	Route::resource('invoice', 'InvoiceController');
	// Route::resource('tasks', 'TaskController');
	Route::resource('charges', 'ChargeController');

	Route::post('updateStatus/{id}', 'ShipmentController@updateStatus')->name('updateStatus');
	Route::post('barcodeUpdate/{bar_code}', 'ShipmentController@barcodeUpdate')->name('barcodeUpdate');
	Route::post('barcodeIn/{bar_code}', 'ShipmentController@barcodeIn')->name('barcodeIn');
	Route::get('csv', 'ShipmentController@csv')->name('csv');
	Route::post('csv/import', 'ShipmentController@import')->name('import');
	Route::get('getShipments', 'ShipmentController@getShipments')->name('getShipments');
	Route::post('csv/export', 'ShipmentController@export')->name('export');
	Route::post('getcoordinatesArray/{id}', 'ShipmentController@getcoordinatesArray')->name('getcoordinatesArray');
	Route::patch('UpdateShipment', 'ShipmentController@UpdateShipment')->name('UpdateShipment');
	Route::post('assignBranch', 'ShipmentController@assignBranch')->name('assignBranch');
	Route::post('assignDriver', 'ShipmentController@assignDriver')->name('assignDriver');
	Route::post('filterShipment', 'ShipmentController@filterShipment')->name('filterShipment');
	
	Route::post('AddShipments/{id}', 'ContainerController@AddShipments')->name('AddShipments');
	Route::post('conupdateStatus/{id}', 'ContainerController@conupdateStatus')->name('conupdateStatus');
	Route::post('getShipmentArray/{id}', 'ContainerController@getShipmentArray')->name('getShipmentArray');
	Route::post('assigndialog/{id}', 'ContainerController@assigndialog')->name('assigndialog');
	Route::post('getContainers', 'ContainerController@getContainers')->name('getContainers');

	Route::post('productAdd/{id}', 'ProductController@productAdd')->name('productAdd');
	Route::post('getProducts', 'ProductController@getProducts')->name('getProducts');

	Route::get('getUsers', 'UserController@getUsers')->name('getUsers');
	Route::get('getDrivers', 'UserController@getDrivers')->name('getDrivers');
	Route::get('getCustomer', 'UserController@getCustomer')->name('getCustomer');
	Route::get('getLogedinUsers', 'UserController@getLogedinUsers')->name('getLogedinUsers');
	Route::post('profile/{id}', 'UserController@profile')->name('profile');
	Route::post('getSorted', 'UserController@getSorted')->name('getSorted');
	Route::post('getUserPro/{id}', 'UserController@getUserPro')->name('getUserPro');


	Route::get('getUsersRole', 'RoleController@getUsersRole')->name('getUsersRole');
	Route::get('getRoles', 'RoleController@getRoles')->name('getRoles');

	Route::get('getBranch', 'BranchController@getBranch')->name('getBranch');
	Route::get('getBranchCharge', 'BranchController@getBranchCharge')->name('getBranchCharge');
	Route::post('getBranchShip/{id}', 'BranchController@getBranchShip')->name('getBranchShip');

	Route::post('getCompanies', 'CompanyController@getCompanies')->name('getCompanies');
	Route::post('getCompanyAdmin', 'CompanyController@getCompanyAdmin')->name('getCompanyAdmin');
	Route::post('companupdate/{id}', 'CompanyController@companupdate')->name('companupdate');
	Route::post('logo/{id}', 'CompanyController@logo')->name('logo');
	Route::post('getLogo', 'CompanyController@getLogo')->name('getLogo');
	Route::post('getLogoOnly', 'CompanyController@getLogoOnly')->name('getLogoOnly');

	// Reports
	Route::post('shipmentExpo', 'ReportController@shipmentExpo')->name('shipmentExpo');
	Route::post('userExpo', 'ReportController@userExpo')->name('userExpo');
	Route::post('deriverdExpo', 'ReportController@deriverdExpo')->name('deriverdExpo');
	Route::post('customersExpo', 'ReportController@customersExpo')->name('customersExpo');
	Route::post('branchesExpo', 'ReportController@branchesExpo')->name('branchesExpo');
	Route::post('agentsExpo', 'ReportController@agentsExpo')->name('agentsExpo');
	Route::post('cancledExpo', 'ReportController@cancledExpo')->name('cancledExpo');
	Route::post('pendingExpo', 'ReportController@pendingExpo')->name('pendingExpo');
	Route::post('bookingExpo', 'ReportController@bookingExpo')->name('bookingExpo');
	Route::post('approvedExpo', 'ReportController@approvedExpo')->name('approvedExpo');
	Route::post('dispatchedExpo', 'ReportController@dispatchedExpo')->name('dispatchedExpo');
	Route::get('userDateExpo', 'ReportController@userDateExpo')->name('userDateExpo');
	Route::post('DriverReport', 'ReportController@DriverReport')->name('DriverReport');

	
	// Dashboard
	Route::get('delayedShipment', 'ShipmentController@delayedShipment')->name('delayedShipment');
	Route::get('approvedShipment', 'ShipmentController@approvedShipment')->name('approvedShipment');
	Route::get('waitingShipment', 'ShipmentController@waitingShipment')->name('waitingShipment');
	Route::get('deriveredShipment', 'ShipmentController@deriveredShipment')->name('deriveredShipment');
	Route::get('scheduled', 'ShipmentController@scheduled')->name('scheduled');

	// Chart
	Route::post('getChartData', 'ShipmentController@getChartData')->name('getChartData');


	// E-MAILS
	Route::post('/sendmail', 'EmailController@sendmail')->name('sendmail');
	Route::post('/getsubscribers', 'EmailController@getsubscribers')->name('getsubscribers');
	Route::post('/subscribe', 'EmailController@subscribe')->name('subscribe');
	Route::post('/refresh/{id}', 'EmailController@refresh')->name('refresh');


	Route::get('/slack', 'EmailController@slack');
	Route::get('/slacks', 'EmailController@slacks');

	Route::get('/getunsubscribed', 'EmailController@getunsubscribed')->name('getunsubscribed');

	// Invoices
	Route::get('/getInvoice', 'InvoiceController@getInvoice')->name('getInvoice');
	Route::post('/getInvoiceSort', 'InvoiceController@getInvoiceSort')->name('getInvoiceSort');
	Route::post('/sendMail', 'InvoiceController@sendMail')->name('sendMail');

	// Roles
	Route::get('getRoles', 'RoleController@getRoles')->name('getRoles');

	
	// file upload
	Route::post('/attachments/store', 'HomeController@store')->name('store-attachments');
	Route::post('/attachments', 'HomeController@pullAttachments')->name('pull-attachments');
	Route::delete('/attachments/', 'HomeController@deleteAttachment')->name('delete-attachment');
	Route::post('/attachments/categories', 'HomeController@getCategories')->name('pull-categories');
	Route::post('/categories', 'HomeController@storeCategories');

	// Date test
	Route::post('/carbon', 'RoleController@carbon')->name('carbon');

	// Reports
	Route::post('/displayReport', 'ReportController@displayReport')->name('displayReport');

	// Notifications
	Route::get('/notifications', 'NotificationController@notifications')->name('notifications');
	Route::post('/Notyshpments/{id}', 'NotificationController@Notyshpments')->name('Notyshpments');
	Route::post('/read', 'NotificationController@read')->name('read');


	// Tasks
	// Route::get('/getTasks', 'TaskController@getTasks')->name('getTasks');

	// Uploads
	Route::get('/upload', 'HomeController@upload')->name('upload');
	Route::get('/categories', 'HomeController@categories')->name('categories');
	Route::get('/getDocs', 'HomeController@getDocs')->name('getDocs');
	Route::get('/getClientsDocs', 'HomeController@getClientsDocs')->name('getClientsDocs');

	Route::post('/assign/{id}', 'HomeController@assign')->name('assign');
	Route::post('/getDocsSort', 'HomeController@getDocsSort')->name('getDocsSort');
	
	// Route::get('scheduler', function (){
	// 	\Illuminate\Support\Facades\Artisan::call('schedule:run');
	//  });

	// Charges
	Route::get('/getCharges', 'ChargeController@getCharges')->name('getCharges');
	Route::post('/shipCharge/{id}', 'ChargeController@shipCharge')->name('shipCharge');
	
	 
});

	// Route::get('scheduler', function (){
	// 	\Illuminate\Support\Facades\Artisan::call('schedule:run');
	//  });