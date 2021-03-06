<?php

namespace App\Http\Controllers;

use App\transaksi;
use Illuminate\Http\Request;
use App\setting;
use App\product;
use App\transaksiDetail;
use Yajra\Datatables\Datatables;
use PDF;

class MyTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setting = setting::where('id', 1)->first();
        $data = 'Transaksi';

        return view('admin.my-transaksi.form', compact('data', 'setting'));
    }

    /**
     * Store/update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        $response = [
            'status' => false,
            'message' => 'Failed to submit inventory data'
        ];

        // Process request
        $summary = json_decode($request->summary);
        $process = transaksi::process($summary);
        if (isset($process['status']) && !$process['status']) {
            return response()->json($process, 422);
        }
        $collection = $process['collection'];
        $data = $collection->except('products')->toArray();
        if (isset($data['id'])) {
            $params = ['id' => $data['id']];
            $model = transaksi::updateOrCreate($params, $data);
        } else {
            $model = new transaksi();
            $model = $model->create($data);
        }
        if (isset($collection['products'])) {
            foreach ($collection['products'] as $row) {
                $response['transaksi_details'][] = transaksiDetail::updateOrCreate(['transaksi_id' => $model->id, 'product_id' => $row['product_id']], $row->toArray());
            }
        }
        $response['status'] = true;
        $response['message'] = 'Successfully submit transaksi data';
        $response['redirect'] = route('my-transaksi');
        $response['model'] = $model;

        return response()->json($response);
    }


    public function report(Request $request){
        $setting = setting::where('id', 1)->first();
        $data = 'Report Transaksi';
    return view('admin.my-transaksi.report', compact('data', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'start' => 'required',
            'end' => 'required',
            
        ]);
    
            $start = $request->start;
            $end = $request->end;
            $transaksiDetail =transaksiDetail::whereBetween('created_at',[$start,$end])->get();
            $total_transaksi= transaksi::whereBetween('created_at',[$start,$end])->sum('total');
            $product= product::whereBetween('created_at',[$start,$end])->sum('buy');
            $laba = $total_transaksi - $product;
            // dd($td);
            $pdf = PDF::loadview('admin.my-transaksi.download',['transaksiDetail'=>$transaksiDetail],['laba'=>$laba]);
            $pdf->setPaper('A4', 'landscape');
         return $pdf->stream();
          
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
     * @param  \App\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaksi $transaksi)
    {
        //
    }
}