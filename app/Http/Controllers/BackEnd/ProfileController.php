<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backEnd.view-profile',compact('user'));
    }

    public function infoUpdate(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $user = User::findOrFail($id);

        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|unique:users,email,'.$user->id,
            'photo' => 'image',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/'.$user->photo));
            $filename = 'user_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $user['photo'] = $filename;
        }
        $user->update();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->back();
    }

    public function passwordUpdate(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $this->validate($request,[
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();
        $hassedPassword = $user->password;
    
        
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        Auth::logout();
        return redirect()->route('login');
    }
}
