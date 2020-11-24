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
        $this->validate($request, [
            'name' => 'required',
            'profile'  => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $file = $request->file('profile');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::putFileAs('public/profile/', $request->file('profile'), $nama_file);
        Auth::user()->update([
            'name' => $request['name'],
            'profile' => $nama_file,
        ]);
        // alert()->success('Success Title', 'Success Message');
        return redirect()->back()->withSuccess('Update Successfully!');
    }
}