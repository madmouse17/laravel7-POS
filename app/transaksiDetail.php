<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksiDetail extends Model
{
    // Guarded attributes
    protected $guarded = ['created_at', 'updated_at'];

    // Incrementing attribute
    public $incrementing = false;

    /**
     * Relationship with transaksis
     */
    public function transaksi()
    {
        return $this->hasOne(transaksi::class, 'id', 'transaksi_id');
    }

    /**
     * Relationship with products
     */
    public function product()
    {
        return $this->hasOne(product::class, 'id', 'product_id');
    }

    /**
     * Process request to submit
     *
     * @param mixed $request
     * @return mixed $collection
     */
    public static function process($request)
    {
         // $response = [
        //     'status' => false,
        //     'message' => 'Failed to process data',
        // ];
        $collection = collect();
        if (isset($request->transaksi_id)) {
            $collection->put('transaksi_id', $request->transaksi_id);
        }

        $product = product::find($request->product_id);
        if($product->stock <= $request->qty  ){
            $response['message'] = 'product tidak mencukupi.';
            return $response;
        }
        $product->stock =$product->stock - $request->qty;
        $product->save();
        $collection->put('product_id', $request->product_id);
        $collection->put('price', $request->price);
        $collection->put('qty', $request->qty);
        $collection->put('total', $request->total);
        return $collection;
    }
}