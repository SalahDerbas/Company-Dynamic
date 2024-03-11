<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Feature;

class FeatureController extends Controller
{
    
    public function index()
    {
        $features = Feature::orderBy('id','desc')->get();
        return view('backEnd.view-feature',compact('features'));
    }

   
    public function create()
    {
        $languages = Language::orderBy('id','desc')->get();
        return view('backEnd.view-feature-create',compact('languages'));
    }

    
    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $this->validate($request,[
            'title' => 'required|string',
            'content' => 'required|string',
            'icon' => 'required|string',
        ]);

        Feature::create([
            'title' => $request->title,
            'content' => $request->content,
            'icon' => $request->icon,
            'lang_id' => $request->lang_id,
        ]);

        notify()->success(A_SUCCESS_DATA_ADD, A_SUCCESS);
        return redirect()->route('features.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        $languages = Language::orderBy('id','desc')->get();

        return view('backEnd.view-feature-edit',compact('feature','languages'));
    }

    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $this->validate($request,[
            'title' => 'required|string',
            'content' => 'required|string',
            'icon' => 'required|string',
        ]);

        $feature = Feature::findOrFail($id);
        $feature->update([
            'title' => $request->title,
            'content' => $request->content,
            'icon' => $request->icon,
            'lang_id' => $request->lang_id,
        ]);

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->route('features.index');
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $feature = Feature::findOrFail($id);
        $feature->delete();

        notify()->success(A_SUCCESS_DATA_DELETE, A_SUCCESS);
        return back();
    }
}
