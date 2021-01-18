<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\category;
use App\product;
use App\supplier;
use Illuminate\Support\Facades\Validator;
use Alert;
use Session;
use Yajra\Datatables\Datatables;
use Redirect;
use Response;
class product_controller extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index']]);
         $this->middleware('permission:product-create', ['only' => ['store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = setting::where('id', 1)->first();
        $category=category::get();
        $supplier=supplier::get();
        $product=product::all();
        //  dd($product);
        return view('admin.product.product_index', compact('setting', 'category', 'supplier', 'product'));
    }

    public function product_json(Request $request)
    {
            if ($request->ajax()) {

            $can_edit = $can_delete = '';
                if (!auth()->user()->can('product-edit')) {
                    $can_edit = "style='display:none;'";
                }
                if (!auth()->user()->can('product-delete')) {
                    $can_delete = "style='display:none;'";
                }
        $data = product::with('category')
                       ->with('supplier')->select('products.*') ;
        return Datatables::of($data)
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d M Y');
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at->format('d M Y');
            })
            ->addColumn('action', function ($data)use ($can_edit, $can_delete) {
                $button ='<button type ="button" class="btn btn-primary align-right btn-sm" name="edit" '. $can_edit .' id="edit" data-id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></button>';
                $button .='
                &nbsp;&nbsp;&nbsp;
                <button type ="button" class="btn btn-danger align-right btn-sm" name="edit" '. $can_delete .' id="hapus" data-id="'.$data->id.'"><i class="fas fa-trash-alt"></i></button>';
                return $button;
            })

            ->rawColumns(['action'])
            ->make(true);
    }
    else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
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
        $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'buy' => 'required',
            'sell' => 'required',
            'stock' => 'required',
            'supplier_id' => 'required',
        ]);
        product::create([
            'barcode' => $request['barcode'],
            'name' => $request['name'],
            'category_id' => $request['category_id'],
            'buy' => $request['buy'],
            'sell' => $request['sell'],
            'stock' => $request['stock'],
            'supplier_id' => $request['supplier_id'],
        ]);
        // alert()->success('Success Title', 'Success Message');
        return redirect()->back()->withSuccess('Product Created Successfully!');
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
        $where = array('id' => $id);
        $product = product::where($where)->first();
        return Response::json($product);
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
        $update=product::find($id);
        $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'buy' => 'required',
            'sell' => 'required',
            'stock' => 'required',
            'supplier_id' => 'required',
        ]);
        $update->update([
            'barcode' => $request['barcode'],
            'name' => $request['name'],
            'category_id' => $request['category_id'],
            'buy' => $request['buy'],
            'sell' => $request['sell'],
            'stock' => $request['stock'],
            'supplier_id' => $request['supplier_id'],
        ]);
        return redirect()->back()->withSuccess('Product Update Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id)->delete();
        return redirect()->back()->withSuccess('Product Deleted Succesfully!');
    }

    /**
     * Search resource based on given params
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = product::query()
            ->where('barcode', 'LIKE', '%' . $request->q . '%')
            ->orWhere('name', 'LIKE', '%' . $request->q . '%');
        $result = $query->get();

        return response()->json($result);
    }
}