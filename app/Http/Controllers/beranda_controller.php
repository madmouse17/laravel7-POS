<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\user;
use App\product;
use App\transaksi;
use Session;
use App\Charts\Day_Income;
use App\Charts\Month_Income;
use DB;
use App\transaksiDetail;
use Charts;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;
class beranda_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting=setting::where('id',1)->first();
        $user = user::count();
        $product=product::count();
        $transaksi=transaksi::count();
        $total_income= transaksi::sum('total');
        $total_spend = product::sum('buy');
      
        $activity = json_decode(Activity::join('users','activity_log.causer_id','=','users.id')
        ->orderby('activity_log.id','desc')
        ->select(['activity_log.description','activity_log.log_name', 'users.username', 'activity_log.description', 'activity_log.properties', 'activity_log.updated_at'])
        ->get()
        ->take(5), true); 

        // chart by days
        $data = collect([]); 
        for ($days_backwards = 7; $days_backwards >= 0; $days_backwards--) {

        $data->push(transaksiDetail::whereDate('created_at', today()->subDays($days_backwards))->count())  ;
        }

        $chart = new Day_income;
        $chart->labels(['1 week ago','6 days ago','5 days ago','4 days ago','3 days ago','2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('Transaksi', 'bar', $data)
            ->color("#ff910a")
            ->backgroundcolor("#ff910a");

// Chart Per month by years
            $now = Carbon::now()->year;
            $data_transaksi = collect([]); 

        for ($month_forward = 1; $month_forward <= 12; $month_forward++) {
        $data_transaksi->push(transaksiDetail::whereYear('created_at',$now)
        ->whereMonth('created_at',$month_forward)
        ->count());
        }
            $chart_month = new Month_income;
                  $chart_month->labels(["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]);
                  $chart_month->dataset('Transaksi','line',$data_transaksi->values());
                  
        return view('admin.dashboard.dashboard_index',compact('setting','user','product','transaksi','total_income','total_spend','chart','chart_month','activity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}