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


//Authentification
Auth::routes();

Route::middleware('auth')->group(function () {
    //Drivers routes
    Route::get('/drivers', 'DriverController@index')->name('drivers');
    Route::get('/driver/create', 'DriverController@create')->name('driver.create');
    Route::post('/driver/store', 'DriverController@store')->name('driver.store');
    Route::get('/driver/edit/{driver_id}', 'DriverController@edit')->name('driver.edit');
    Route::post('/driver/update/{driver_id}', 'DriverController@update')->name('driver.update');
    Route::get('/driver/delete/{driver_id}', 'DriverController@delete')->name('driver.delete');

    //Trucks routes
    Route::get('/trucks', 'TruckController@index')->name('trucks');
    Route::get('/truck/create', 'TrucKController@create')->name('truck.create');
    Route::post('/truck/store', 'TruckController@store')->name('truck.store');
    Route::get('/truck/delete/{truck_id}', 'TruckController@delete')->name('truck.delete');

    //Bookings routes
    Route::get('/', 'BookingController@index')->name('home');
    Route::get('/bookings', 'BookingController@index')->name('bookings');
    Route::get('/booking/create', 'BookingController@create')->name('booking.create');
    Route::post('booking/store', 'BookingController@store')->name('booking.store');
    Route::get('/booking/edit/{id}', 'BookingController@edit')->name('booking.edit');
    Route::post('/booking/update/{id}', 'BookingController@update')->name('booking.update');
    Route::get('/booking/delete/{id}', 'BookingController@delete')->name('booking.delete');

    //Clients routes
    Route::get('/clients', 'ClientController@index')->name('clients');
    Route::get('/client/create', 'ClientController@create')->name('client.create');
    Route::post('/client/store', 'ClientController@store')->name('client.store');
    Route::get('/client/edit{id}', 'ClientController@edit')->name('client.edit');
    Route::post('/client/update{id}', 'ClientController@update')->name('client.update');
    Route::get('/client/delete{id}', 'ClientController@delete')->name('client.delete');

    //Cities routes
    Route::get('/city/create', 'CityController@create')->name('city.create');
    Route::post('/city/store', 'CityController@store')->name('city.store');

    //select2 routes
    Route::get('/select2/cities', 'Select2Controller@citySelect2')->name('select.city');
    Route::get('/select2/clients', 'Select2Controller@clientSelect2')->name('select.client');
    Route::get('/select2/trucks', 'Select2Controller@truckSelect2')->name('select.truck');
    Route::get('/select2/drivers', 'Select2Controller@driverSelect2')->name('select.driver');
    Route::get('/select2/bookings/{id}', 'Select2Controller@bookingSelect2')->name('select.booking');
    Route::get('/select2/booking/{id}', 'Select2Controller@bookingSelect2Single')->name('select.booking.single');


//Filter routes
    Route::post('/filter/bookings', 'BookingsFilterController@filterBookings')->name('filter.bookings');

    //Invoice routes
    Route::get('/invoices', 'InvoiceController@index')->name('invoices');
    Route::get('/invoice/create/{booking?}', 'InvoiceController@create')->name('invoice.create');
    Route::post('/invoice/store', 'InvoiceController@store')->name('invoice.store');
    Route::get('/invoice/edit/{invoice}', 'InvoiceController@edit')->name('invoice.edit');
    Route::post('/invoice/update{id}', 'InvoiceController@update')->name('invoice.update');
    Route::get('/invoice/pdf/{invoice}', 'InvoiceController@getPDF')->name('invoice.pdf');
    Route::get('invoice/delete/{invoice}', 'InvoiceController@delete')->name('invoice.delete');
    Route::get('invoice/export}', 'InvoiceController@export')->name('invoices.export');
    Route::post('invoice/export_view}', 'InvoiceController@export_view')->name('invoices.export_view');

});





