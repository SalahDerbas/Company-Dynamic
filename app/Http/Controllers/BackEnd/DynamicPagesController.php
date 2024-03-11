<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DynamicPage;
use App\Models\Language;
use Str;

class DynamicPagesController extends Controller
{
    
    public function index()
    {
        $all_dynamic_pages = DynamicPage::orderBy('id','desc')->get();
        return view('backEnd.view-dynamic-page',compact('all_dynamic_pages'));
    }

    
    public function create()
    {
        $languages = Language::orderBy('id','desc')->get();
        return view('backEnd.view-dynamic-page-create',compact('languages'));
    }

    
    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $request['slug'] = Str::slug($request['slug'],'-');
        $this->validate($request,[
            'name'    => 'required|string',
            'slug'    => 'required|unique:dynamic_pages',
            'content' => 'required|string',
            'banner'  => 'required|image',
        ]);

        /* start image part */
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = 'dynamic_page_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
        }
        /* end image part */

        DynamicPage::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'content' => $request->content,
            'banner' => $filename,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'lang_id' => $request->lang_id,
        ]);

        notify()->success(A_SUCCESS_DATA_ADD, A_SUCCESS);
        return redirect()->route('dynamic-pages.index');
    }

    
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        $dynamic_page = DynamicPage::findOrFail($id);
        $languages = Language::orderBy('id','desc')->get();

        return view('backEnd.view-dynamic-page-edit',compact('dynamic_page','languages'));
    }
    
    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $dynamic_page = DynamicPage::findOrFail($id);
        $request['slug'] = Str::slug($request['slug'],'-');
        $this->validate($request,[
            'name'    => 'required|string',
            'slug'    => 'required|unique:dynamic_pages,slug,'.$dynamic_page->id,
            'content' => 'required|string',
            'banner'  => 'image',
        ]);

        $dynamic_page->name    = $request->name;
        $dynamic_page->slug    = Str::slug($request->slug);
        $dynamic_page->content = $request->content;
        /* start image part */
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            @unlink(public_path('upload/'.$dynamic_page->banner));
            $filename = 'dynamic_page_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $dynamic_page['banner'] = $filename;
        }
        /* end image part */
        $dynamic_page->meta_title       = $request->meta_title;
        $dynamic_page->meta_description = $request->meta_description;
        $dynamic_page->lang_id          = $request->lang_id;
        $dynamic_page->update();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->route('dynamic-pages.index');
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $dynamic_page = DynamicPage::findOrFail($id);
            if (file_exists(public_path('upload/' . $dynamic_page->banner)) AND ! empty($dynamic_page->banner)) {
                unlink(public_path('upload/' . $dynamic_page->banner));
            }
        $dynamic_page->delete();

        notify()->success(A_SUCCESS_DATA_DELETE, A_SUCCESS);
        return back();
    }
}