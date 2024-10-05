<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;


Route::controller(Auth\LoginController::class)->middleware('guest:admin')->name('admin_')->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
});

Route::middleware('auth:admin')->name('admin_')->group(function () {
    Route::post('/logout', [Auth\LoginController::class, 'destroy'])->name('logout');

    /**
     * Dashboard
     */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('dashboard')->name('dashboard_')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    /**
     * Role
     */
//    Route::controller(RolesController::class)->middleware('auth')->prefix('role')->name('role_')->group(function () {
//        Route::get('/', 'listRoles')->name('list');
//        Route::post('table', 'rolesListData')->name('table');
//        Route::get('add', 'addRole')->name('add');
//        Route::post('create', 'createRole')->name('create');
//        Route::get('edit', 'editRole')->name('edit');
//        Route::post('update', 'updateRole')->name('update');
//        Route::post('status_change', 'statusChange')->name('status_change');
//        Route::get('delete', 'deleteRole')->name('delete');
//    });

    /**
     * User
     */
    Route::controller(UsersController::class)->middleware('auth:admin')->prefix('user')->name('user_')->group(function () {
        Route::get('/', 'index')->middleware('permission:user_read')->name('index');
        Route::get('list/{active?}', 'result')->middleware('permission:user_read')->name('list');
        Route::get('create-update/{id?}', 'createUpdate')->middleware('permission:user_update')->name('create_update');
        Route::post('create-update', 'createUpdatePost')->middleware('permission:user_update')->name('create_update_post');
        Route::get('action/{id}/{status}', 'action')->name('action');
        Route::get('change_password', 'changeUserPassword')->name('change_password');
        Route::post('update_password', 'updateUserPassword')->name('update_password');
    });

    /**
     * Settings
     */
    Route::controller(SettingsController::class)->middleware('auth:admin')->prefix('settings')->name('settings_')->group(function () {
        Route::get('/', 'view')->name('view');
        Route::post('general/save', 'saveGeneral')->name('general_save');
        Route::post('save', 'save')->name('save');
        Route::get('favicon/remove', 'removeFavicon')->name('remove_favicon');
        Route::get('dark_logo/remove', 'removeDarkLogo')->name('remove_dark_logo');
        Route::get('light_logo/remove', 'removeLightLogo')->name('remove_light_logo');
        Route::post('link', 'linkSave')->name('link_save');
        Route::post('currency/save', 'saveCurrency')->name('currency_save');
    });

    /**
     *Banner
     */
    Route::controller(BannerController::class)->middleware('auth')->prefix('banner')->name('banner_')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::post('table', 'table')->name('table');
        Route::get('view', 'view')->name('view');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'save')->name('save');
        Route::get('edit', 'edit')->name('edit');
        Route::get('remove_file', 'removeFile')->name('remove_file');
        Route::post('update', 'update')->name('update');
        Route::get('delete', 'delete')->name('delete');
        Route::post('status', 'status')->name('status');
    });

    /**
     *Srevices
     */
    Route::controller(ServicesController::class)->middleware('auth')->prefix('services')->name('services_')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::post('table', 'table')->name('table');
        Route::get('view', 'view')->name('view');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'save')->name('save');
        Route::get('edit', 'edit')->name('edit');
        Route::get('remove_file', 'removeFile')->name('remove_file');
        Route::post('update', 'update')->name('update');
        Route::get('delete', 'delete')->name('delete');
        Route::post('status', 'status')->name('status');
    });

    /**
     * Enquiries
     */
    Route::controller(EnquiryController::class)->middleware('auth')->prefix('enquiry')->name('enquiry_')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::post('table', 'table')->name('table');
        Route::get('view', 'view')->name('view');
        Route::get('delete', 'delete')->name('delete');
    });

    /**
     * Cms
     */
    Route::controller(CmsController::class)->middleware('auth')->prefix('cms')->name('cms_')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::post('table', 'table')->name('table');
        Route::get('view', 'view')->name('view');
        Route::get('add', 'add')->name('add');
        Route::post('save', 'save')->name('save');
        Route::get('edit', 'edit')->name('edit');
        Route::get('remove_file', 'removeFile')->name('remove_file');
        Route::post('update', 'update')->name('update');
        Route::get('delete', 'delete')->name('delete');
        Route::post('status', 'status')->name('status');
    });

    /**
     * Options
     */
    Route::controller(OptionsController::class)->prefix('options')->name('options_')->group(function () {
        Route::get('cms_categories','cmsCategories')->name('cms_categories');
    });

    /**
     * Bank
     */
    Route::controller(BankController::class)->middleware('auth:admin')->prefix('bank')->name('bank_')->group(function () {
        Route::get('/', 'index')->middleware('permission:bank_read')->name('index');
        Route::get('list/{from_date?}/{to_date?}/{active?}/{export?}', 'result')->middleware('permission:bank_read')->name('list');
        Route::get('create-update/{id?}', 'createUpdate')->middleware('permission:bank_create')->name('create_update');
        Route::post('create-update', 'createUpdatePost')->middleware('permission:bank_create')->name('create_update_post');
        Route::get('action/{id}/{status}', 'action')->name('action');
    });

    /**
     * Role
     */
    Route::controller(RoleController::class)->middleware('auth:admin')->prefix('role')->name('role_')->group(function () {
        Route::get('/', 'index')->middleware('permission:role_read')->name('index');
        Route::get('list/{active?}', 'result')->middleware('permission:role_read')->name('list');
        Route::get('create-update/{id?}', 'createUpdate')->middleware('permission:role_create')->name('create_update');
        Route::post('create-update', 'createUpdatePost')->middleware('permission:role_create')->name('create_update_post');
        Route::get('action/{id}/{status}', 'action')->name('action');
    });
});

