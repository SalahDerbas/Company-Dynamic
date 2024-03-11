<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    
    public function index()
    {
        $files = File::orderBy('id','desc')->get();
        return view('backEnd.view-file',compact('files'));
    }

    
    public function create()
    {
        return view('backEnd.view-file-create');
    }

   
    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $this->validate($request,[
            'title'     => 'required|string',
            'file_name' => 'required',
        ]);

        /* start file part */
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $filename = 'file_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
        }
        /* end file part */

        File::create([
            'title'     => $request->title,
            'file_name' => $filename,
        ]);

        notify()->success(A_SUCCESS_DATA_ADD, A_SUCCESS);
        return redirect()->route('files.index');
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $file = File::findOrFail($id);
        return view('backEnd.view-file-edit',compact('file'));
    }

    
    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $this->validate($request,[
            'title' => 'required|string'
        ]);

        $update_file = File::findOrFail($id);
        /* start file part */
        if ($request->file('file_name')) {
            $file = $request->file('file_name');
            @unlink(public_path('upload/'.$update_file->file_name));
            $filename = 'file_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move('upload/',$filename);
            $update_file->file_name = $filename;
        }
        /* end file part */
        $update_file->title      = $request->title;
        $update_file->save();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->route('files.index');
    }

   
    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $file = File::findOrFail($id);
            if (file_exists(public_path('upload/' . $file->file_name)) AND ! empty($file->file_name)) {
                unlink(public_path('upload/' . $file->file_name));
            }
        $file->delete();

        notify()->success(A_SUCCESS_DATA_DELETE, A_SUCCESS);
        return back();
    }

    public function download($id)
    {
        $file = File::find($id);
        return response()->download('upload/'.$file->file_name);
    }
}
