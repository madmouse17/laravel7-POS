<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class transaksi extends Model
{
    // Guarded attributes
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['transaksi'];

    /**
     * Get transaksi
     *
     * @return string
     */
    public function getTransaksiAttribute()
    {
        return $this->invoice_id . ' - ' . Date::parse($this->created_at)->format('d-m-Y');
    }

    /**
     * Relationship with transaksi_details
     */
    public function transaksi_details()
    {
        return $this->hasMany(transaksiDetail::class, 'transaksi_id', 'id')->with('product');
    }

    /**
     * Relationship with users
     */
    public function cashier()
    {
        return $this->hasOne(User::class, 'id', 'cashier_id');
    }

    /**
     * Process request to submit
     *
     * @param mixed $request
     * @return mixed $response
     */
    public static function process($request)
    {
        $response = [
            'status' => false,
            'message' => 'Failed to process data',
        ];
        $collection = collect();
        if (isset($request->id)) {
            $collection->put('id', $request->id);
            $collection->put('updated_by', Auth::user()->id);
        } else {
            $collection->put('created_by', Auth::user()->id);
            $collection->put('updated_by', Auth::user()->id);
        }
        $generate = IdGenerator::generate(['table' => 'transaksis', 'length' => 10, 'prefix' =>'INV-'.date('ym').Auth::user()->id, 'field' => 'invoice_id']);
        
        $collection->put('invoice_id', $generate);
        // $collection->put('invoice_id', $request->invoice_id);
        $collection->put('cashier_id', Auth::user()->id);
        $collection->put('subtotal', $request->subtotal);
        $collection->put('discount', $request->discount);
        $collection->put('total', $request->total);
        $collection->put('grandtotal', $request->grandtotal);
        $collection->put('payment', $request->payment);
        $collection->put('change', $request->change);

        if (count($request->products) < 1) {
            $response['message'] = 'Please select product.';
            return $response;
        }
        $products = collect();
        foreach ($request->products as $item) {
            if (isset($request->id)) {
                $item->transaksi_id = $request->id;
            }
            $products->push(transaksiDetail::process($item));
        }
        if (isset($request->id)) {
            transaksiDetail::where('transaksi_id', $request->id)->delete();
        }
        $collection->put('products', $products);

        $response['status'] = true;
        $response['collection'] = $collection;
        return $response;
    }
}