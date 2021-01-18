<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\user;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Redirect, Response;
use Alert;
use App\setting;
use Illuminate\Validation\Rule;
use Session;
use Spatie\Permission\Models\Role;
use DB;
class user_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
         $this->middleware('permission:user-create', ['only' => ['store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user= user::Orderby('id','desc')->get();
        $setting=setting::where('id',1)->first();
        $role=role::get();
        
        return view('admin.user.user_index',compact('setting','role'));
    }
    public function json(Request $request)
    {
        if ($request->ajax()) {

            $can_edit = $can_delete = '';
                if (!auth()->user()->can('user-edit')) {
                     $can_edit = "style='display:none;'";
                }
                if (!auth()->user()->can('user-delete')) {
                     $can_delete = "style='display:none;'";
                }
        $data = user::query();
        return Datatables::of($data)
            ->addColumn('action', function ($data) use ($can_edit, $can_delete) {
                $button ='<button type ="button" class="btn btn-primary align-right btn-sm" name="edit" '. $can_edit .' id="edit" data-id="'.$data->id.'"><i class="fas fa-pencil-alt"></i></button>';
                $button .='
                &nbsp;&nbsp;&nbsp;
                <button type ="button" class="btn btn-danger align-right btn-sm" name="edit" '. $can_delete .' id="hapus" data-id="'.$data->id.'"><i class="fas fa-trash-alt"></i></button>';
                return $button;
            })
            
            ->rawColumns(['action','role'])
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users|alpha_dash',
            'password' => 'required|string|min:6|confirmed',
            'profile'  => 'required|image|mimes:jpeg,png,jpg',
            'roles' => 'required'
        ]);
        $file = $request->file('profile');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::putFileAs('public/profile/', $request->file('profile'), $nama_file);
        $user=user::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
            'profile' => $nama_file,
        ]);
        $user->assignRole($request->input('roles'));
        // alert()->success('Success Title', 'Success Message');
        return redirect()->back()->withSuccess('User Created Successfully!');
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
        $user = user::where($where)->first();
        return Response::json($user);
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
       
        $update = user::find($id);
        $profile_name = $request->profile_name;
        $profile= $request-> file('profile');
        if ($profile !='') {
            Storage::delete('public/profile/'. $update->profile);
        $this->validate($request, [
            'name' => 'required',
            'profile'  => 'image|mimes:jpeg,png,jpg',
        ]);
        $profile_name = $request->file('profile');
        $nama_file = time() . "_" . $profile->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::putFileAs('public/profile/', $request->file('profile'), $nama_file);
        $update->update([
            'name' => $request['name'],
            'profile' => $nama_file,
            
        ]);
        } else{
            
            $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'email' ,
                        Rule::unique('users', 'email')
                        ->ignore($update->id)],
            'username' => ['required', 'string', 'max:500','alpha_dash',
                        Rule::unique('users', 'username')
                         ->ignore($update->id)],
            'password' => 'confirmed',
            'roles' => 'required'
        ]);
            $update->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
           
            ]);}
            DB::table('model_has_roles')->where('model_id',$id)->delete();
             $update->assignRole($request->input('roles'));
        
        return redirect()->back()->withSuccess('User Update Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = user::where('id', $id)->first();
        Storage::delete('public/profile/' . $user->profile);
        user::find($id)->delete();

        return redirect()->back()->withSuccess('User Deleted Succesfully!');
    }
}