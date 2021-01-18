<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use Yajra\Datatables\Datatables;
use Session;
use Spatie\Activitylog\Models\Activity;
class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = setting::where('id',1)->first();
        return view('admin.log-activity.index',compact('setting'));
    }

    public function log_json()
    {
        $data = Activity::join('users','activity_log.causer_id','=','users.id')
        ->select(['activity_log.description','activity_log.log_name', 'users.username', 'activity_log.description', 'activity_log.properties', 'activity_log.updated_at']);
        return Datatables::of($data)
        ->editColumn('updated_at', function ($data) {
                return $data->updated_at->format('d M Y');
            })
            ->make(true);
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