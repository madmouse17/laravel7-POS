<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use Illuminate\Support\Facades\Storage;
use Alert;
use Session;
class setting_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = setting::where('id',1)->first();
        return view('admin.user.setting_index',compact('setting'));
    }

  
    public function icon(Request $request)
    {
        $this->validate($request, [
            'icon' => 'required|mimes:ico',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('icon');
 
        $nama_file = time() . "_" .$file->getClientOriginalName();
 
                // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::putFileAs('public/icon/',$request->file('icon'),$nama_file);
        

      setting::where('id',1)->update([
            'icon' =>  $nama_file,
            ]);
       
     return redirect()->back()->withSuccess('Change Password Successfully!');
    }

    public function logo(Request $request){
        $this->validate($request, [
            'logo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('logo');
 
        $nama_file = time() . "_" .$file->getClientOriginalName();
 
                // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::putFileAs('public/logo/',$request->file('logo'),$nama_file);
        

      setting::where('id',1)->update([
            'logo' =>  $nama_file,
            ]);
       
     return redirect()->back()->withSuccess('Change Password Successfully!');

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
            'perusahaan' => 'required',
            'tagline'=>'required'
        ]);
        setting::where('id',1)->update([
            'perusahaan' =>  $request['perusahaan'],
            'tagline'=>$request['tagline']
            ]);
            return redirect()->back()->withSuccess('Change Password Successfully!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}