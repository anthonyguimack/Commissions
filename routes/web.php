<?php

use App\Http\Controllers\CommissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 

//for version 9+
Route::controller(CommissionController::class)->group(function () {
    Route::get('/commissions', 'index'); 
    //Route::post('/commissions', 'store');
    Route::get('/commissions_users/{partner_id}', 'commissions_users');
    Route::get('/commissions_users_optimizado/{partner_id}', 'commissions_users_optimizado');
    Route::get('/commissions_users_1Mpast/{partner_id}', 'commissions_users_1Mpast');
    Route::post('/commissions_users_exists/{partner_id}', 'commissions_users_exists');
    Route::post('/commissions_users_history/{partner_id}', 'commissions_users_history');
    
    Route::post('/commissions_detail/{commission_id}', 'commissions_detail');
    
    Route::get('/commissions_users_1S/{partner_id}', 'commissions_users_1S');
    Route::get('/commissions_users_2S/{partner_id}', 'commissions_users_2S');
    Route::get('/commissions_users_2/{partner_id}', 'commissions_users_2');

    Route::post('/simulation_commissions', 'simulation_commissions');
    Route::post('/simulation_commissions_2', 'simulation_commissions_2');
    Route::post('/simulation_commissions_3', 'simulation_commissions_3');
    Route::post('/simulation_commissions_1_1S', 'simulation_commissions_1_1S');
    Route::post('/simulation_commissions_2_1S', 'simulation_commissions_2_1S');
    Route::post('/simulation_commissions_1_2S', 'simulation_commissions_1_2S');
    Route::post('/simulation_commissions_2_2S', 'simulation_commissions_2_2S');

    Route::post('/sum-amp/{partner_id}','sumAmp');

    //Microservices Users - Dashboard for Tracks 1 y 2
    Route::post('/commissions_users_track_1mes/{partner_id}', 'commissions_users_track_1mes');
    Route::post('/commissions_users_track_2mes/{partner_id}', 'commissions_users_track_2mes');
    Route::post('/commissions_users_track_3mes/{partner_id}', 'commissions_users_track_3mes');
    Route::post('/commissions_users_track_4mes/{partner_id}', 'commissions_users_track_4mes');
    
    //Reporte Bono Constancia
    Route::get('/bono_constancia', 'bono_constancia');
    Route::post('/bono_constancia_store/{partner_id}', 'bono_constancia_store');

    //Cierre de Mes
    Route::post('/simulation_commissions_cierre_mes', 'simulation_commissions_cierre_mes');
    Route::post('/simulation_commissions_2_cierre_mes', 'simulation_commissions_2_cierre_mes');
    Route::post('/users_cierre_mes/{partner_id}', 'users_cierre_mes');    
    Route::post('/update_range_user/{partner_id}', 'update_range_user');
    Route::post('/commission_detail/{commission_id}', 'commission_detail');
    Route::post('/commission_detail_list', 'commission_detail_list');
    Route::post('/commission_detail_list_2', 'commission_detail_list_2');
    Route::post('/update_detail_commission/{id_detail_commission}', 'update_detail_commission');
    Route::post('/commissions_users_history_cronjob/{partner_id}', 'commissions_users_history_cronjob');
    Route::get('/commissions_users_history_by_range_cronjob', 'commissions_users_history_by_range_cronjob');
    Route::post('/commissions_users_history_by_range_update_cronjob/{id}', 'commissions_users_history_by_range_update_cronjob');
    Route::post('/update_commissions_type_1/{partner_id}', 'update_commissions_type_1');
    Route::post('/update_commissions_type_2/{partner_id}', 'update_commissions_type_2');
    Route::post('/update_detail_commission_type_1/{commission_id}', 'update_detail_commission_type_1');
    Route::post('/update_detail_commission_type_2/{commission_id}', 'update_detail_commission_type_2');
    Route::get('/commissions_details_delete/{period}', 'commissions_details_delete');
    

    // For Dashboard - Admin
    Route::get('/users_actives_months/{period}', 'users_actives_months');
    Route::get('/quantity_members_discounts/{period}', 'quantity_members_discounts');
    Route::get('/quantity_members_discounts_year/{period}', 'quantity_members_discounts_year');
    Route::get('/commissions_generated_network/{period}', 'commissions_generated_network');
    Route::get('/commissions_generated_sale/{period}', 'commissions_generated_sale');  


    Route::get('/commissions_user_history/{partner_id}', 'commissions_user_history');
    Route::get('/commissions_user_history_detail/{id}', 'commissions_user_history_detail');  
    Route::get('/commissions_user_history_detail2/{id}', 'commissions_user_history_detail2');  

});
