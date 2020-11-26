<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\user;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Redirect, Response;
use Alert;
class user_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user= user::Orderby('id','desc')->get();
        
        return view('admin.user.user_index');
    }
    public function json()
    {
        $data = user::latest()->get();
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
            'password' => 'required|string|min:6|confirmed',
            'profile'  => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $file = $request->file('profile');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::putFileAs('public/profile/', $request->file('profile'), $nama_file);
        user::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'profile' => $nama_file,
        ]);
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
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required|string|min:6|confirmed',
        //     'profile'  => 'required|image|mimes:jpeg,png,jpg',
        // ]);
        // $update = user::find($id);
        // $update->name = $request->name;
        // $update->email = $request->email;
        // $update->password = bcrypt($request->password);
        // $update->update($request->only('profile'));
        // if ($request->hasFile('profile')) {


        //     $file = $request->file('profile');
        //     $nama_file = time() . "_" . $file->getClientOriginalName();
        //     $tujuan = Storage::putFileAs('public/profile/', $request->file('profile'), $nama_file);
        //     $update->profile = $nama_file;

        //     $update->save();
        $update = user::find($id);
        $profile_name = $request->profile_name;
        $profile= $request-> file('profile');
        if ($profile !='') {
            Storage::delete('public/profile/'. $update->profile);
        $this->validate($request, [
            'name' => 'required',
            'profile'  => 'image|mimes:jpeg,png,jpg',
            'email' => 'required',
            'password' => 'confirmed',
        ]);
        $profile_name = $request->file('profile');
        $nama_file = time() . "_" . $profile->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::putFileAs('public/profile/', $request->file('profile'), $nama_file);
        $update->update([
            'name' => $request['name'],
            'profile' => $nama_file,
            'email' => $request['email'],
        ]);
        } else{
            $update->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            ]);}
        
        return redirect()->back()->withSuccess('User Update Succesfully!');;
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
        user::where('id', $id)->delete();

        return redirect()->back()->withSuccess('User Deleted Succesfully!');
    }
}