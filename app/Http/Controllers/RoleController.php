<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\setting;
use Yajra\Datatables\Datatables;
use Response;
use Alert;
class RoleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting=setting::where('id',1)->first();
        $permission = Permission::get();
       $role = role::all();
      
    return view('admin.role.role_index',compact('permission','setting','role'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));


        return redirect()->back()
                        ->withSuccess('Role created successfully');
    }

    public function role_json(Request $request)
    {
        if ($request->ajax()) {

        $can_edit = $can_delete = '';
            if (!auth()->user()->can('role-edit')) {
                $can_edit = "style='display:none;'";
            }
            if (!auth()->user()->can('role-delete')) {
                $can_delete = "style='display:none;'";
            }
        $data = role::query() ;
        return Datatables::of($data)

         ->editColumn('created_at', function ($data)  {
                return $data->updated_at->format('d M Y');
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at->format('d M Y');
            })

            ->addColumn('action', function ($data)use ($can_edit, $can_delete) {
                $button ='<button type ="button" class="btn btn-primary align-right btn-sm" name="edit" '. $can_edit .' id="edit" data-id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></button>';
                $button .='
                &nbsp;&nbsp;&nbsp;
                <button type ="button" class="btn btn-danger align-right btn-sm" name="edit" id="hapus" '. $can_delete .' data-id="'.$data->id.'"><i class="fas fa-trash-alt"></i></button>';
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
        $role = role::where($where)->first();
        return Response::json($role);
      
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->back()
                        ->withSuccess('Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $role= role::find($id);
        $role->delete();
        return redirect()->back()
                        ->withSuccess('Role deleted successfully');
    }
}