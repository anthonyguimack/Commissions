<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\CommissionDetail;
use App\Models\BonoConstancia;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    public function index()
    {
        //Commission Month Now - comming soon
        //$commission = Commission::where('status', 'A')
        $commission = Commission::orderBy('id')
                    ->Where('commissions_1_level','>',0)
                    ->orWhere('sales_commissions','>',0)
                    ->get();
        return response()->json($commission);
    }

    public function commissions_users($partner_id){
        $period = date("Y-m");

        $commissions_users = Commission::where('partner_id', '=', $partner_id)
                ->where('status', '=', 'A')
                ->where('period', '=', $period)
                ->count();
        
        if ($commissions_users==1){
            $commissions_users_data = Commission::select(array('amp','personal_discount','personal_discount_history','amp_history'))
                ->where('partner_id', '=', $partner_id)
                ->where('period', '=', $period)
                ->where('status', '=', 'A')
                ->get();
            return response()->json($commissions_users_data);
        }else{
            return response()->json($commissions_users);
        }
    }

    public function commissions_users_1Mpast($partner_id){
        $period = date("Y-m");
        $period_past = date("Y-m",strtotime($period."- 1 month"));

        $commissions_users = Commission::where('partner_id', '=', $partner_id)
                ->where('status', '=', 'A')
                ->where('period', '=', $period_past)
                ->count();
        
        if ($commissions_users==1){
            $commissions_users_data = Commission::select('range')
                ->where('partner_id', '=', $partner_id)
                ->where('period', '=', $period_past)
                ->where('status', '=', 'A')
                ->get();
            return response()->json($commissions_users_data);
        }else{
            return response()->json($commissions_users);
        }
    }

    public function commissions_user_history($partner_id){

        $commissions_user_history = Commission::where('partner_id', '=', $partner_id)
                ->where(function($query) {
                    $query->where('commissions_1_level', '>', 0)
                          ->orWhere('sales_commissions', '>', 0);
                })
                ->where('status', '=', 'A')
                ->get();

        return response()->json($commissions_user_history);
        
    }

    public function commissions_user_history_detail($id){

        $commissions_user_history_detail = Commission::where('id', '=', $id)
                ->where('status', '=', 'A')
                ->get();

        return response()->json($commissions_user_history_detail);
        
    }

    public function commissions_user_history_detail2($id){

        $commissions_user_history_detail2 = CommissionDetail::where('commission_id', '=', $id)
                ->where('status', '=', 'A')
                ->orderBy('id', 'asc')
                ->get();

        return response()->json($commissions_user_history_detail2);
        
    }

    

    //INFORMACIÓN SEMESTRAL
    //1er Semestre
    public function commissions_users_1S($partner_id){
        $from = date("Y").'-01';
        $to = date("Y").'-06';

        $commissions_users = Commission::where('partner_id', '=', $partner_id)
                ->where('status', '=', 'A')
                ->whereBetween('period', [$from, $to])
                ->count();
        
        if ($commissions_users>0){
            $commissions_users_data = Commission::select('amp')
                ->where('partner_id', '=', $partner_id)
                ->whereBetween('period', [$from, $to])
                ->where('status', '=', 'A')
                ->sum('amp');
                //->get();
            return response()->json($commissions_users_data);
        }else{
            return response()->json($commissions_users);
        }
    }

    //2do Semestre
    public function commissions_users_2S($partner_id){
        $from = date("Y").'-07';
        $to = date("Y").'-12';

        $commissions_users = Commission::where('partner_id', '=', $partner_id)
                ->where('status', '=', 'A')
                ->whereBetween('period', [$from, $to])
                ->count();
        
        if ($commissions_users>0){
            $commissions_users_data = Commission::select('amp')
                ->where('partner_id', '=', $partner_id)
                ->whereBetween('period', [$from, $to])
                ->where('status', '=', 'A')
                ->sum('amp');
                //->get();
            return response()->json($commissions_users_data);
        }else{
            return response()->json($commissions_users);
        }
    }
    //END INFORMACIÓN SEMESTRAL

    //Admin - Red del Socio
    public function commissions_users_2($partner_id){
        $period = date("Y-m");
        $commissions_users_2 = Commission::where('partner_id', '=', $partner_id)
                ->where('status', '=', 'A')
                ->where('period', '=', $period)
                ->count();

        //return $commissions_users_2;
        
        if ($commissions_users_2==1){
            $commissions_users_data = Commission::select('amp')
                ->where('partner_id', '=', $partner_id)
                ->where('period', '=', $period)
                ->where('status', '=', 'A')
                ->first();
            return $commissions_users_data['amp'];
        }else{
            return response()->json($commissions_users_2);
        }
    }

    public function commissions_users_3($partner_id){
        $period = date("Y-m");
        $commissions_users_3 = Commission::where('partner_id', '=', $partner_id)
                ->where('status', '=', 'A')
                ->where('period', '=', $period)
                ->count();
        
        if ($commissions_users_3==1){
            $commissions_users_data = Commission::select('amp')
                ->where('partner_id', '=', $partner_id)
                ->where('period', '=', $period)
                ->where('status', '=', 'A')
                ->first();
            return $commissions_users_data['amp'];
        }else{
            return response()->json($commissions_users_3);
        }
    }

    public function commissions_users_4($partner_id){
        $period = date("Y-m");
        $commissions_users_4 = Commission::where('partner_id', '=', $partner_id)
                ->where('status', '=', 'A')
                ->where('period', '=', $period)
                ->count();
        
        if ($commissions_users_4==1){
            $commissions_users_data = Commission::select('amp')
                ->where('partner_id', '=', $partner_id)
                ->where('period', '=', $period)
                ->where('status', '=', 'A')
                ->first();
            return $commissions_users_data['amp'];
        }else{
            return response()->json($commissions_users_4);
        }
    }
    //End - Admin - Red del Socio

    //Comisiones Mi Red
    public function simulation_commissions(Request $request){

        $explode_id = array_map('intval', explode(',', $request->users_1_level_ids));
        $period = date("Y-m");
        //return $explode_id;

        $simulation_commissions = Commission::select('amp')
                ->whereIn('partner_id', $explode_id)
                ->where('period', '=', $period)
                ->where('status', '=', 'A')
                ->sum('amp');
                //->get();

        return response()->json($simulation_commissions);
    }

    public function simulation_commissions_2(Request $request){

        $explode_id2 = array_map('intval', explode(',', $request->users_2_level_ids));
        $period = date("Y-m");

        $simulation_commissions2 = Commission::select('amp')
                ->whereIn('partner_id', $explode_id2)
                ->where('period', '=', $period)
                ->where('status', '=', 'A')
                ->sum('amp');
                //->get();

        return response()->json($simulation_commissions2);
        //return $users_1_level_ids;
    }

    //public function simulation_commissions_3(Request $request){
    public function simulation_commissions_3(){
        $red_hijos_1_nivel = $request->red_hijos_1_nivel;
        return $red_hijos_1_nivel;
    }

    //INFORMACIÓN SEMESTRAL
    //1er Semestre
    public function simulation_commissions_1_1S(Request $request){

        $explode_id = array_map('intval', explode(',', $request->users_1_level_ids));
        $from = date("Y").'-01';
        $to = date("Y").'-06';
        //return $explode_id;

        $simulation_commissions = Commission::select('amp')
                ->whereIn('partner_id', $explode_id)
                ->whereBetween('period', [$from, $to])
                ->where('status', '=', 'A')
                ->sum('amp');

        return response()->json($simulation_commissions);
    }

    public function simulation_commissions_2_1S(Request $request){

        $explode_id2 = array_map('intval', explode(',', $request->users_2_level_ids));
        $from = date("Y").'-01';
        $to = date("Y").'-06';

        $simulation_commissions2 = Commission::select('amp')
                ->whereIn('partner_id', $explode_id2)
                ->whereBetween('period', [$from, $to])
                ->where('status', '=', 'A')
                ->sum('amp');

        return response()->json($simulation_commissions2);
        //return $users_1_level_ids;
    }

    //2do Semestre
    public function simulation_commissions_1_2S(Request $request){

        $explode_id = array_map('intval', explode(',', $request->users_1_level_ids));
        $from = date("Y").'-07';
        $to = date("Y").'-12';
        //return $explode_id;

        $simulation_commissions = Commission::select('amp')
                ->whereIn('partner_id', $explode_id)
                ->whereBetween('period', [$from, $to])
                ->where('status', '=', 'A')
                ->sum('amp');

        return response()->json($simulation_commissions);
    }

    public function simulation_commissions_2_2S(Request $request){

        $explode_id2 = array_map('intval', explode(',', $request->users_2_level_ids));
        $from = date("Y").'-07';
        $to = date("Y").'-12';

        $simulation_commissions2 = Commission::select('amp')
                ->whereIn('partner_id', $explode_id2)
                ->whereBetween('period', [$from, $to])
                ->where('status', '=', 'A')
                ->sum('amp');

        return response()->json($simulation_commissions2);
        //return $users_1_level_ids;
    }
    //End Comisiones Mi Red


    public function commissions_users_exists($partner_id, Request $request){
        $period = date("Y-m");
        $commission = Commission::where('partner_id', '=', $partner_id)
                ->where('period', '=', $period)
                ->count();

        if($commission==0){
            //Insert new register
            $commission = new Commission();
            $commission->partner_id = $request->partner_id;
            $commission->amp = $request->amp;
            $commission->personal_discount = $request->personal_discount;
            $commission->amp_history = $request->amp;
            $commission->personal_discount_history = $request->personal_discount;
            $commission->partner_name = $request->partner_name;
            $commission->period = $period;
            $commission->range = $request->range;
            $commission->status = 'A';

            $commission->profit_1_level = $request->profit_1_level;
            $commission->profit_2_level = $request->profit_2_level;

            $commission->save();
            //$commission->id = $commission->id;

            //return $commission;
            return response()->json([$commission]);

        }elseif($commission==1){
            //Update register
            $commission = Commission::select(array('id','amp','personal_discount','amp_history','personal_discount_history'))
                ->where('partner_id', '=', $partner_id)
                ->where('period', '=', $period)
                ->get();


            foreach ($commission as $item) {
                $product['amp'] = $item["amp"]+$request->amp;
                //$product['amp_history'] = $item["amp_history"]+$request->amp;
                $product['personal_discount'] = $request->personal_discount;
                //$product['personal_discount_history'] = $request->personal_discount;
            }

            $commission2 = Commission::where('partner_id', '=', $partner_id)
                        ->where('period', '=', $period)
                        ->update(array('amp' => $product['amp'], 'personal_discount' => $product['personal_discount'], 'range' => $request->range));
                        //->update(array('amp' => $product['amp'], 'personal_discount' => $product['personal_discount'], 'personal_discount_history' => $product['personal_discount_history'], 'range' => $request->range));
            
            $commission_new = Commission::select(array('id','amp','personal_discount','amp_history','personal_discount_history'))
                ->where('partner_id', '=', $partner_id)
                ->where('period', '=', $period)
                ->get();

            return response()->json($commission_new);           
            
        }

        
    }


    public function commissions_users_history($partner_id, Request $request){
        
        //Insert new register
        $commission = new Commission();
        $commission->partner_id = $partner_id;
        $commission->amp = $request->amp_history;
        $commission->period = $request->period;
        $commission->personal_discount = $request->personal_discount_history;
        $commission->personal_discount_history = $request->personal_discount_history;
        //$commission->range = $request->range;
        $commission->status = 'A';

        $commission->save();
        return response()->json([$commission]);

        
    }



    public function commissions_detail($commission_id, Request $request){

        $commission_detail = new CommissionDetail();
        $commission_detail->commission_id = $commission_id;
        $commission_detail->type = $request->type;
        $commission_detail->partner_id = $request->partner_id;
        $commission_detail->partner_name = $request->partner_name;
        $commission_detail->level = $request->level;
        $commission_detail->id_order = $request->id_order;
        $commission_detail->date_commission = $request->date_commission;
        $commission_detail->amount = $request->amount;
        $commission_detail->points = $request->points;
        $commission_detail->percentage = $request->percentage;
        $commission_detail->commissions_points = $request->commissions_points;
        $commission_detail->commissions_money = $request->commissions_money;
        $commission_detail->save();
        $commission_detail->id = $commission_detail->id;

        return response()->json($commission_detail);
    }    

    public function sumAmp($partner_id, Request $request) {
        $period = date("Y-m");
        
        $commission = Commission::where('partner_id',$partner_id)
                                ->where('period', '=', $period)
                                ->first();
        $commission->amp = $commission->amp  + $request->amp;
        $commission->personal_discount = $request->discount_applied_cart_in;      
        $commission->update();
        return response()->json($commission);
    }


    //Microservices Users - Dashboard for Tracks 1 y 2
    public function commissions_users_track_1mes($partner_id, Request $request){        
        $period = $request->month_1;

        $commissions_users_data = Commission::select('amp')->where('partner_id', '=', $partner_id)->where('period', '=', $period)->where('status', '=', 'A')
                                ->get();
        
        if($commissions_users_data!='[]'){
            foreach ($commissions_users_data as $item) {
                $data['amp'] = $item["amp"];
            }            
        }else{
            $data['amp'] = 0;
        }
        return response()->json($data);
    }

    public function commissions_users_track_2mes($partner_id, Request $request){        
        $period = $request->month_2;

        $commissions_users_data = Commission::select('amp')->where('partner_id', '=', $partner_id)->where('period', '=', $period)->where('status', '=', 'A')
                                ->get();

        if($commissions_users_data!='[]'){
            foreach ($commissions_users_data as $item) {
                $data['amp'] = $item["amp"];
            }
        }else{
            $data['amp'] = 0;
        }
        return response()->json($data);
    }

    public function commissions_users_track_3mes($partner_id, Request $request){        
        $period = $request->month_3;

        $commissions_users_data = Commission::select('amp')->where('partner_id', '=', $partner_id)->where('period', '=', $period)->where('status', '=', 'A')
                                ->get();

        if($commissions_users_data!='[]'){
            foreach ($commissions_users_data as $item) {
                $data['amp'] = $item["amp"];
            }
        }else{
            $data['amp'] = 0;
        }       
        return response()->json($data); 
    }

    public function commissions_users_track_4mes($partner_id, Request $request){        
        $period = $request->month_4;

        $commissions_users_data = Commission::select('amp')->where('partner_id', '=', $partner_id)->where('period', '=', $period)->where('status', '=', 'A')
                                ->get();
        
        if($commissions_users_data!='[]'){
            foreach ($commissions_users_data as $item) {
                $data['amp'] = $item["amp"];
            }
        }else{
            $data['amp'] = 0;
        }
        return response()->json($data);
    }


    public function bono_constancia(){

        $bono_constancia = BonoConstancia::select('*')
                            //->orderBy('id_bono', 'desc')
                            ->orderBy('track_active', 'asc')
                            ->get();
        return response()->json($bono_constancia);
    }

    public function bono_constancia_store($partner_id, Request $request){

        $bono_constancia = BonoConstancia::where('partner_id', '=', $partner_id)
                ->where('status', '=', 'A')
                ->get();

        if ($bono_constancia=='[]'){
            $bono = new BonoConstancia();
            $bono->partner_id = $partner_id;
            $bono->partner_name = $request->partner_name;
            $bono->affiliation_date = $request->affiliation_date;
            $bono->points_month1 = $request->points_month1;
            $bono->track_active = $request->track_active;
            $bono->status = 'A';
            $bono->premio = $request->premio;
            $bono->save();
            return response()->json($bono);
        }else{
            $bono = BonoConstancia::where('partner_id',$partner_id)
                                        ->first();

            if($request->points_month2!=''){
                $bono->points_month2 = $request->points_month2;
            }elseif($request->points_month3!=''){
                $bono->points_month3 = $request->points_month3;
            }elseif($request->points_month4!=''){
                $bono->points_month4 = $request->points_month4;
            }

            $bono->premio = $request->premio;
            $bono->update();
            return response()->json($bono);
        }
    }


    //Cierre de Mes
    public function users_cierre_mes($partner_id, Request $request){

        $period = $request->period;

        $amp = Commission::select('amp','personal_discount')->where('partner_id', '=', $partner_id)->where('period', '=', $period)->where('status', '=', 'A')
                                ->get();

        if($amp=='[]'){
            return response()->json(0);
        }else{
            return response()->json($amp);
        }
    }


    public function update_range_user($partner_id, Request $request){

        $period = $request->period;
        $range = $request->range;
        $active_directories_required = $request->active_directories_required;
        $profit_1_level = $request->profit_1_level;
        $profit_2_level = $request->profit_2_level;
        $commissions_1_level = $request->commissions_1_level;
        $commissions_2_level = $request->commissions_2_level;


        $update_range_user = Commission::where('partner_id', $partner_id)
                        ->where('period', '=', $period)
                        ->update(array('range' => $range, 'active_directories_required' => $active_directories_required, 'profit_1_level' => $profit_1_level, 'profit_2_level' => $profit_2_level, 'commissions_1_level' => $commissions_1_level, 'commissions_2_level' => $commissions_2_level));


        $period2 = date("Y-m");

        $update_range_user2 = Commission::where('partner_id', $partner_id)
                        ->where('period', '=', $period2)
                        ->update(array('range' => $range));

        return response()->json($update_range_user);
    }



    public function commission_detail($commission_id, Request $request){

        //Insert new register
        $commission = new CommissionDetail();
        $commission->commission_id = $commission_id;
        $commission->type = $request->type;
        $commission->partner_id = $request->partner_id;
        $commission->partner_name = $request->partner_name;
        $commission->level = $level;
        $commission->id_order = $request->id_order;
        $commission->amount = $request->amount;
        $commission->points = $request->points;
        $commission->status = 'A';

        $commission->profit_1_level = $request->profit_1_level;
        $commission->profit_2_level = $request->profit_2_level;

        $commission->save();
        return response()->json([$commission]);

    }


    public function commission_detail_list(Request $request){

        $explode_id = array_map('intval', explode(',', $request->ids));
        $period = $request->period;

        $commission_detail_list = CommissionDetail::select('*')
                ->whereIn('partner_id', $explode_id)
                ->where('period', '=', $period)
                ->where('level', '=', '1')
                ->where('status', '=', 'A')
                ->whereNull('calculated')
                ->get();

        return response()->json($commission_detail_list);
    }


    public function commission_detail_list_2(Request $request){

        $explode_id = array_map('intval', explode(',', $request->ids));
        $period = $request->period;

        $commission_detail_list = CommissionDetail::select('*')
                ->whereIn('partner_id', $explode_id)
                ->where('period', '=', $period)
                ->where('level', '=', '2')
                ->where('status', '=', 'A')
                ->whereNull('calculated')
                ->get();

        return response()->json($commission_detail_list);
    }

    public function update_detail_commission_type_1($commission_id, Request $request){

        $commission_detail = new CommissionDetail();
        $commission_detail->commission_id = $commission_id;
        $commission_detail->date_commission = Carbon::now();
        $commission_detail->partner_id = $request->partner_id;
        $commission_detail->partner_name = $request->partner_name;
        $commission_detail->id_order = $request->id_order;
        $commission_detail->amount = $request->amount;
        $commission_detail->points = $request->points;     
        $commission_detail->period = $request->period;
        $commission_detail->payment_date = $request->payment_date;
        $commission_detail->level = $request->level;
        $commission_detail->type = 'red';
        $commission_detail->status = 'A';
        $commission_detail->save();
        $commission_detail->id = $commission_detail->id;

        return response()->json($commission_detail);
    }

    public function update_detail_commission($id_detail_commission, Request $request){
        
        $id_detail_commission = $id_detail_commission;
        $period = $request->period;
        $commissions_money = $request->commissions_money;
        $commissions_points = $request->commissions_points;
        $level = $request->level;
        $percentage = $request->percentage;


        $update = CommissionDetail::where('id', $id_detail_commission)
                        ->where('type', '=', 'red')
                        ->where('period', '=', $period)
                        ->update(array('commissions_money' => $commissions_money, 'commissions_points' => $commissions_points, 'percentage' => $percentage, 'calculated' => 'ok'));

        return response()->json($update);

    }

    public function quantity_members_discounts($period){
        //$period = date("Y-m");
        //$period = '2023-01';

        /*$quantity_members_discounts = DB::table('commissions')
                ->select('personal_discount', DB::raw('count(partner_id) as total'))
                ->where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->groupBy('commissions.personal_discount')
                ->orderBy('commissions.personal_discount')
                ->get();*/

        /*$quantity_members_discounts[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount', '=', 0)
                ->count();*/

        $quantity_members_discounts[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount', '=', 15)
                ->count();

        $quantity_members_discounts[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount', '=', 20)
                ->count();

        $quantity_members_discounts[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount', '=', 25)
                ->count();

        $quantity_members_discounts[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount', '=', 30)
                ->count();

        $quantity_members_discounts[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount', '=', 35)
                ->count();

        return response()->json($quantity_members_discounts);
    }

    public function quantity_members_discounts_year($period){

        /*$quantity_members_discounts_year[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount', '=', 0)
                ->count();*/

        $quantity_members_discounts_year[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount_history', '=', 15)
                ->count();

        $quantity_members_discounts_year[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount_history', '=', 20)
                ->count();

        $quantity_members_discounts_year[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount_history', '=', 25)
                ->count();

        $quantity_members_discounts_year[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount_history', '=', 30)
                ->count();

        $quantity_members_discounts_year[] = Commission::where('commissions.period', '=', $period)
                ->where('commissions.status', '=', 'A')
                ->where('commissions.personal_discount_history', '=', 35)
                ->count();

        return response()->json($quantity_members_discounts_year);

        /*if($quantity_members_discounts!='[]'){
            return response()->json($quantity_members_discounts);
        }else{
            return 0;
        }   */     
    }

    public function commissions_generated_network($period)
    {
        $commissions_generated_network = CommissionDetail::where('period', '=', $period)
                ->where('type', '=', 'red')
                ->where('status', '=', 'A')
                ->sum('commissions_points');

        return response()->json($commissions_generated_network);
    }

    public function commissions_generated_sale($period)
    {
        $commissions_generated_sale = CommissionDetail::where('period', '=', $period)
                ->where('type', '=', 'venta')
                ->where('status', '=', 'A')
                ->sum('commissions_money');

        return response()->json($commissions_generated_sale);
    }    

    public function commissions_users_history_cronjob($partner_id, Request $request){
        
        $commission = new Commission();
        $commission->partner_id = $partner_id;
        $commission->period = $request->period;
        $commission->amp_history = $request->amp_history;
        $commission->personal_discount_history = $request->personal_discount_history;
        $commission->status = 'A';
        $commission->save();
        $commission->id = $commission->id;
        return response()->json($commission);

    }   

    public function commissions_users_history_by_range_cronjob(){
        
        $date_now = date('Y-m');
       
        $commission = Commission::select(array('id','amp_history'))
            ->where('range', '!=', 'Waterlife')
            ->where('period', '=', $date_now)
            ->get();

        return response()->json($commission);

    }   

    public function commissions_users_history_by_range_update_cronjob($id, Request $request){
        
        $commission = Commission::where('id', '=', $id)
                    ->update(array('personal_discount_history' => $request->personal_discount_history));

    }

    public function update_commissions_type_1($partner_id, Request $request){

        $period = $request->period;

        //Update commissions
        $commission = Commission::select(array('id'))
            ->where('partner_id', '=', $partner_id)
            ->where('period', '=', $period)
            ->get();

        if($commission!='[]'){
            foreach ($commission as $item) {
                $commission_id = $item["id"];
            }
        }else{
            $commission_id = 0;
        }

        return response()->json($commission_id);

    }


    public function update_commissions_type_2($partner_id, Request $request){

        $period = $request->period;

        //Update commissions
        $commission = Commission::select(array('id','sales_commissions'))
            ->where('partner_id', '=', $partner_id)
            ->where('period', '=', $period)
            ->get();


        foreach ($commission as $item) {
            $sales_commissions_total = $item["sales_commissions"]+$request->sales_commissions;
            $commission_id = $item["id"];
        }

        $commission2 = Commission::where('partner_id', '=', $partner_id)
                    ->where('period', '=', $period)
                    ->update(array('sales_commissions' => $sales_commissions_total));

        return response()->json($commission_id);

    }


    public function update_detail_commission_type_2($commission_id, Request $request){

        $commission_detail = new CommissionDetail();
        $commission_detail->commission_id = $commission_id;
        $commission_detail->date_commission = Carbon::now();
        $commission_detail->partner_id = $request->partner_id;
        $commission_detail->partner_name = $request->partner_name;
        $commission_detail->id_order = $request->id_order;
        $commission_detail->amount = $request->amount;
        $commission_detail->commissions_money = $request->sales_commissions;
        $commission_detail->points = 0; 
        $commission_detail->percentage = 0; 
        $commission_detail->commissions_points = 0;         
        $commission_detail->period = $request->period;
        $commission_detail->payment_date = $request->payment_date;
        $commission_detail->level = 0;
        $commission_detail->type = 'venta';
        $commission_detail->calculated = 'ok';
        $commission_detail->status = 'A';
        $commission_detail->save();
        $commission_detail->id = $commission_detail->id;

        return response()->json($commission_detail);
    }


    public function simulation_commissions_cierre_mes(Request $request){

        $explode_id = array_map('intval', explode(',', $request->users_1_level_ids));
        $period = $request->period;
        //return $explode_id;

        $simulation_commissions = Commission::select('amp')
                ->whereIn('partner_id', $explode_id)
                ->where('period', '=', $period)
                ->where('status', '=', 'A')
                ->sum('amp');
                //->get();

        return response()->json($simulation_commissions);
    }

    public function simulation_commissions_2_cierre_mes(Request $request){

        $explode_id2 = array_map('intval', explode(',', $request->users_2_level_ids));
        $period = $request->period;

        $simulation_commissions2 = Commission::select('amp')
                ->whereIn('partner_id', $explode_id2)
                ->where('period', '=', $period)
                ->where('status', '=', 'A')
                ->sum('amp');
                //->get();

        return response()->json($simulation_commissions2);
        //return $users_1_level_ids;
    }

    public function users_actives_months($period)
    {
        
        $users_actives_months = Commission::select('id')
                ->where('period', '=', $period)
                ->where('amp', '>', 74)
                ->count();

        return response()->json($users_actives_months);
    }

    public function commissions_details_delete($period)
    {
        
        $commissions_details_delete = CommissionDetail::where('period', '=', $period)
                ->where('points', '>', 0)
                ->where('percentage', '=', 0)
                ->where('commissions_money', '=', 0)
                ->where('commissions_money', '=', 0)               
                ->delete();

        return response()->json($commissions_details_delete);
    }

    



}
