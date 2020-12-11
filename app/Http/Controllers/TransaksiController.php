<?php

namespace App\Http\Controllers;

use App\transaksi;
use Illuminate\Http\Request;
use App\setting;
use App\product;
use Illuminate\Support\Facades\Validator;
use Alert;
use Session;
use Yajra\Datatables\Datatables;
use Redirect;
use Response;
use Darryldecode\Cart\CartCondition;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setting=setting::where('id', 1)->first();
        $data ='Transaksi';


        $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'discount',
                'type' => 'tax', //tipenya apa
                'target' => 'total', //target kondisi ini apply ke mana (total, subtotal)
                'value' => '0%', //contoh -12% or -10 or +10 etc

            ));
        \Cart::session(Auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent();

        if (\Cart::isEmpty()) {
            $cart_data = [];
        } else {
            foreach ($items as $row) {
                $cart[] = [
                    'rowId' => $row->id,
                    'name' => $row->name,
                    'qty' => $row->quantity,
                    'pricesingle' => $row->price,
                    'price' => $row->getPriceSum(),
                ];
            }

            $cart_data = collect($cart);
        }



        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        $new_condition = \Cart::session(Auth()->id())->getCondition('discount');
        $discount = $new_condition->getCalculatedValue($sub_total);

        $data_total = [
            'sub_total' => $sub_total,
            'total' => $total,
            'discount' => $discount,
        ];

        return view('admin.transaksi.transaksi_index', compact('setting', 'data', 'cart_data', 'data_total'));
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

    public function addProductCart(Request $request)
    {
        // $product = Product::find($id);

        $cart = \Cart::session(Auth()->id())->getContent();
        // $cek_itemId = $cart->whereIn('id', $id);

        // if($cek_itemId->isNotEmpty()){
        //     if($product->qty == $cek_itemId[$id]->quantity){
        //         return redirect()->back()->with('error','jumlah item kurang');
        //     }else{
        //         \Cart::session(Auth()->id())->update($id, array(
        //             'quantity' => 1
        //         ));
        //     }
        // }else{
        \Cart::session(Auth()->id())->add(array(
            'id' => $request['product_id'],
            'name' => $request['name'],
            'price' => $request['sell'],
            'quantity' => $request['qty'],
        ));


        return redirect()->back();
    }
    public function removeProductCart($id)
    {
        \Cart::session(Auth()->id())->remove($id);

        return redirect()->back();
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
