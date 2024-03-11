<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Language;

class TestimonialController extends Controller
{
    
    public function index()
    {
        $testimonials = Testimonial::orderBy('id','desc')->get();
        return view('backEnd.view-testimonial',compact('testimonials'));
    }

    
    public function create()
    {
        $languages = Language::orderBy('id','desc')->get();
        return view('backEnd.view-testimonial-create',compact('languages'));
    }

    
    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $this->validate($request,[
            'name'        => 'required|string',
            'designation' => 'required|string',
            'comment'     => 'required|string',
            'photo'       => 'required|image',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name        = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment     = $request->comment;
        /* start image part */
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'testimonial_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $testimonial['photo'] = $filename;
        }
        /* end image part */
        $testimonial->lang_id   = $request->lang_id;
        $testimonial->save();

        notify()->success(A_SUCCESS_DATA_ADD, A_SUCCESS);
        return redirect()->route('testimonials.index');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $languages   = Language::orderBy('id','desc')->get();

        return view('backEnd.view-testimonial-edit',compact('testimonial','languages'));
    }

    
    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $this->validate($request,[
            'name'       => 'required|string',
            'designation'=> 'required|string',
            'comment'    => 'required|string',
            'photo'      => 'image',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->name        = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment     = $request->comment;
        /* start image part */
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/'.$testimonial->photo));
            $filename = 'testimonial_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $testimonial['photo'] = $filename;
        }
        /* end image part */
        $testimonial->lang_id   = $request->lang_id;
        $testimonial->update();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->route('testimonials.index');
    }

   
    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $testimonial = Testimonial::findOrFail($id);
        if (file_exists(public_path('upload/' . $testimonial->photo)) AND !empty($testimonial->photo)) {
            unlink(public_path('upload/' . $testimonial->photo));
        }
        $testimonial->delete();

        notify()->success(A_SUCCESS_DATA_DELETE, A_SUCCESS);
        return back();
    }
}
