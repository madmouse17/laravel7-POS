<?php

namespace App\Http\Controllers;

use App\transaksi;
use Illuminate\Http\Request;
use App\setting;
use App\product;
use App\transaksiDetail;
use Yajra\Datatables\Datatables;

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

    public function product_json()
    {
        $data = product::query();
        return Datatables::of($data)
            // ->editColumn("created_at", function ($data) {
            //     return date("m/d/Y", strtotime($data->created_at));
            // })
            ->addColumn('action', function ($data) {
                $button ='<button type ="button" class="btn btn-success align-right btn-sm" name="select" id="select"
                    data-id="'.$data->id.'"
                    data-barcode="'.$data->barcode.'"
                    data-name="'.$data->name.'"
                    data-sell="'.$data->sell.'"
                    data-buy="'.$data->buy.'"
                    data-stock="'.$data->stock.'"
                ><i class="fas fa-check"></i></button>';
                // $button .='
                // &nbsp;&nbsp;&nbsp;
                // <button type ="button" class="btn btn-danger align-right btn-sm" name="edit" id="hapus" data-id="'.$data->id.'"><i class="fas fa-trash-alt"></i></button>';
                return $button;
            })

            ->rawColumns(['action'])
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
