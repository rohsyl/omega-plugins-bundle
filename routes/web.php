<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Admin\Contact\ContactController;

Route::prefix('admin/plugins')->middleware(['web', 'auth', 'om_admin_locale'])->group(function() {

    // Plugin contact
    Route::get('contacts/index', [ContactController::class, 'index'])->name('omega-plugins-bundle.contacts.index');
    Route::post('contacts/update', [ContactController::class, 'update'])->name('omega-plugins-bundle.contacts.update');

});