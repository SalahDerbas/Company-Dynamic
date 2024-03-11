<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Category;
use Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('backEnd.view-category',compact('categories'));
    }

    public function create()
    {
        $languages = Language::orderBy('id','desc')->get();
        return view('backEnd.view-category-create',compact('languages'));
    }

    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $request['slug'] = Str::slug($request['slug'],'-');
        $this->validate($request,[
            'name'   => 'required|string',
            'slug'   => 'required|string|unique:categories',
            'banner' => 'required|image',
        ]);
        
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = 'news_category_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
        }
        
        Category::create([
            'name'             => $request->name,
            'slug'             => Str::slug($request->slug),
            'banner'           => $filename,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'lang_id'          => $request->lang_id,
        ]);

        notify()->success(A_SUCCESS_DATA_ADD, A_SUCCESS);
        return redirect()->route('categories.index');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $languages   = Language::orderBy('id','desc')->get();

        return view('backEnd.view-category-edit',compact('category','languages'));
    }

    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $category = Category::findOrFail($id);
        $this->validate($request,[
            'name'   => 'required|string',
            'slug'   => 'required|string|unique:categories,slug,'.$category->id,
            'banner' => 'image',
        ]);

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            @unlink(public_path('upload/'.$category->banner));
            $filename = 'news_category_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $category['banner'] = $filename;
        }

        $category->name             = $request->name;
        $category->slug             = Str::slug($request->slug);
        $category->meta_title       = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->lang_id          = $request->lang_id;
        $category->update();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $category = Category::findOrFail($id);
        if (file_exists(public_path('upload/' . $category->banner)) AND ! empty($category->banner)) {
            unlink(public_path('upload/' . $category->banner));
        }
        $category->delete();

        notify()->success(A_SUCCESS_DATA_DELETE, A_SUCCESS);
        return back();
    }
}
