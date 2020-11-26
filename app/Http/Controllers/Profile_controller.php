<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Alert;
class Profile_controller extends Controller
{
    public function index()
    {

        return view('admin.user.profile_index');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        Auth::user()->update([
            'password' =>  bcrypt($request['password']),
        ]);
        return redirect()->back()->withSuccess('Change Password Successfully!');
    }
    public function update(Request $request)
    {
        $profile_name = $request->profile_name;
        $profile= $request-> file('profile');
        if ($profile !='') {
            Storage::delete('public/profile/'. Auth::user()->profile);
        $this->validate($request, [
            'name' => 'required',
            'profile'  => 'image|mimes:jpeg,png,jpg',
        ]);
        $profile_name = $request->file('profile');
        $nama_file = time() . "_" . $profile->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::putFileAs('public/profile/', $request->file('profile'), $nama_file);
        Auth::user()->update([
            'name' => $request['name'],
            'profile' => $nama_file,
        ]);
        } else{
            Auth::user()->update([
            'name' => $request['name'],
            ]);}
        // alert()->success('Success Title', 'Success Message');
        return redirect()->back()->withSuccess('Update Successfully!');
    }
}