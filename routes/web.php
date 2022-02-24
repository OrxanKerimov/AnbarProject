<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'guest', 'prefix' => '/user'], function (){ // создана группа с запретом для входа на эти страницы авторизованным лицам и так же добавлен префикс USER к url
    Route::get('/register','user\RegisterController@index')->name('register.create'); // открывает шаблонизатор для страницы регистрации
    Route::post('/register','user\RegisterController@store')->name('register.store'); // отправляет данные регистрации нового пользователя
    Route::get('/login','user\LoginController@loginForm')->name('login.create'); // открывает шаблонизатор для стриницы логина
    Route::post('/login','user\LoginController@login')->name('login.store'); // отправляет данные для входа в аккаунт
    Route::view('/recover','anbar.pages.recover.recover')->name('recover'); // открывает шаблонизатор для восстановления пароля
    Route::post('/recover','LoginController@recover')->name('recover.store'); // отпраляет данные для отправки сообщения с ссылкой для восстановления пароля

});

Route::group(['middleware' => 'auth'], function (){ // создана группа с запретом для входа на эти страницы неавторизованным лицам
    Route::get('/main','MainController@index')->name('index.main'); // открывает шаблонизатор для главной страницы
    Route::get('/logout','user\LoginController@logout')->name('index.logout'); // ссылка выхода из аккаунта

    Route::get('/brands','pages\BrandController@create')->name('brand.create'); // открывает шаблонизатор для страницы таблицы брендов
    Route::post('/brands','pages\BrandController@store')->name('brand.store'); // отправляет даныые для добалвения нового бренда в таблицу
    Route::get('/brands/{id}/edit','pages\BrandController@edit')->name('brand.edit'); // открывает шаблонизатор для редактирования определенного бредна
    Route::post('/brands/{id}','pages\BrandController@destroy')->name('brand.delete'); // отправляет данные для изменения отпределенного бренда
    Route::post('/brands/{id}/edit','pages\BrandController@update')->name('brand.update'); // удаляет определенный бренд

    Route::get('/products','pages\ProductController@create')->name('product.create'); // открывает шаблонизатор для страниццы таблицы товаров
    Route::post('/products','pages\ProductController@store')->name('product.store'); // отправляет данные для добавления нового товара в таблицу
    Route::get('/products/{id}/edit','pages\ProductController@edit')->name('product.edit'); // открывает шаблонизатор для редактирования определеннного товара
    Route::post('/products/{id}','pages\ProductController@destroy')->name('product.delete'); // удаляет определенный товар
    Route::post('/products/{id}/edit','pages\ProductController@update')->name('product.update'); // отправляет данные для редактирования отпреденного товар

    Route::get('/clients','pages\ClientController@create')->name('client.create'); // открывает шаблонизатор для страницы таблицы клиентов
    Route::post('/clients','pages\ClientController@store')->name('client.store'); // отправляет данные для добавления нового клиента в таблицу
    Route::get('/clients/{id}/edit','pages\ClientController@edit')->name('client.edit'); // открывает шаблонизатор для редактирования определенного клиента
    Route::post('/clients/{id}','pages\ClientController@destroy')->name('client.delete'); // удаляет определенного клиента
    Route::post('/clients/{id}/edit','pages\ClientController@update')->name('client.update'); // отрпавляет данные для редактирования нового клиента

    Route::get('/costs','pages\CostController@create')->name('cost.create'); // открывает шаблонизатор для страницы таблицы доп затрат
    Route::post('/costs','pages\CostController@store')->name('cost.store'); // отправляет данные для добавления новых доп затрат в таблицу
    Route::get('/costs/{id}/edit','pages\CostController@edit')->name('cost.edit'); // открывает шаблонизатор для редактирования отпределенной доп затраты
    Route::post('/costs/{id}','pages\CostController@destroy')->name('cost.delete');  // удаляет определенную доп затрату
    Route::post('/costs/{id}/edit','pages\CostController@update')->name('cost.update'); // отправляет данные для редактрирования отпределенной доп затраты

    Route::get('/orders','pages\OrderController@create')->name('order.create'); // открывает шаблонизатор для страницы таблицы заказов
    Route::post('/orders','pages\OrderController@store')->name('order.store'); // отправляет данные для добавления нового заказа в таблицу
    Route::get('/orders/{id}/edit','pages\OrderController@edit')->name('order.edit'); // открывает шаблонизатор для редактирования отпределенного заказа
    Route::post('/orders/{id}','pages\OrderController@destroy')->name('order.delete'); // удаляет определенный заказ
    Route::post('/orders/{id}/edit','pages\OrderController@update')->name('order.update'); // отправляет данные для редактирования отпределенного заказа
    Route::get('/orders/confirmation/{id}','pages\OrderController@confirmation')->name('order.confirmation'); // ссылка для подтверждения определенного заказа
    Route::get('/orders/cancellation/{id}','pages\OrderController@cancellation')->name('order.cancellation'); // ссылка для отмены определенного заказа

    Route::group(['middleware' => 'admin'],function (){ // подключения посредника админ
        Route::get('/employees','pages\EmployeeController@create')->name('employee.create'); // открывает шаблонизатор для страницы таблицы сотрудников
        Route::post('/employees','pages\EmployeeController@store')->name('employee.store'); // отправляет данные для регистрации нового сотрудника
        Route::get('/employees/{id}/accept','pages\EmployeeController@accept')->name('employee.accept'); // ссылка на подтверждения доступа новому пользователю к данным в анбар странице
        Route::get('/employees/{id}/block','pages\EmployeeController@block')->name('employee.block'); // ссылка на блокировку определенного пользователя
        Route::get('/employees/{id}/unlock','pages\EmployeeController@unlock')->name('employee.unlock'); // ссылка на разблокировку определенного пользователя
        Route::post('/employees/{id}','pages\EmployeeController@destroy')->name('employee.delete'); // удаление определенного пользователя
        Route::get('/employees/{id}/edit','pages\EmployeeController@edit')->name('employee.edit'); // открывает шаблонизатор для редактирования отпредленного сотрудника
        Route::post('/employees/{id}/edit','pages\EmployeeController@update')->name('employee.update'); // отпраляет данные для редактирования отпределенного сотрудника
    });

    Route::get('/profile','pages\ProfileController@index')->name('profile.index'); // открывает шаблонизатор для страницы профиля
    Route::get('/profile/edit','pages\ProfileController@edit')->name('profile.edit'); // открывает шаблонизатор для редактирования данных пользователя
    Route::post('/profile/{id}/edit','pages\ProfileController@update')->name('profile.update'); // отправляет данные для редактирования профиля
    Route::view('/profile/editp','anbar.pages.profile.editp')->name('profile.editp'); // открывает шаблонизатор для редактирования пароля пользователя
    Route::post('/profile/editp','pages\ProfileController@updatep')->name('profile.updatep'); // отправляет данные для изменения пароля пользователя
    Route::post('/profile/delete','pages\ProfileController@destroy')->name('profile.delete'); // удаляет пользователя (если он админ то удаляются все данные онбаре вместе с ним)

});


Route::fallback(function ()
{
    return redirect()->route('login.create'); // при попытке войти на незарегестрированную ссылку пользователь будет перекинут на ссылку входа или на главную страницу
});
