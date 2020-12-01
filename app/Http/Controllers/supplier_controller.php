<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\supplier;
use Session;
use Alert;
use Redirect,Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
class supplier_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting=setting::where('id',1)->first();
        return view ('admin.supplier.supplier_index',compact('setting'));
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
    public function supplier_json()
    {
        $data = supplier::query();
        return Datatables::of($data)
            // ->editColumn("created_at", function ($data) {
            //     return date("m/d/Y", strtotime($data->created_at));
            // })
            ->addColumn('action', function ($data) {
                $button ='<button type ="button" class="btn btn-primary align-right btn-sm" name="edit" id="edit" data-id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></button>';
                $button .='
                &nbsp;&nbsp;&nbsp;
                <button type ="button" class="btn btn-danger align-right btn-sm" name="edit" id="hapus" data-id="'.$data->id.'"><i class="fas fa-trash-alt"></i></button>';
                return $button;
            })
            
            ->rawColumns(['action'])
            ->make(true);
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
            'name' => 'required',
            'alamat'=>'required',
            'telp'=>'required'
        ]);
        supplier::create([
            'name' => $request['name'],
            'alamat' => $request['alamat'],
            'telp' => $request['telp'],
        ]);
        // alert()->success('Success Title', 'Success Message');
        return redirect()->back()->withSuccess('Supplier Created Successfully!');
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
        $supplier = supplier::where($where)->first();
        return Response::json($supplier);
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
        $update=supplier::find($id);
        $this->validate($request, [
            'name' => 'required',
            'alamat'=>'required',
            'telp'=>'required',
        ]);
        $update->update([
            'name' => $request['name'], 
            'alamat' => $request['alamat'], 
            'telp' => $request['telp'], 
        ]);
        return redirect()->back()->withSuccess('Supplier Update Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = supplier::find($id)->delete();
        return redirect()->back()->withSuccess('Supplier Deleted Succesfully!');
    }
}