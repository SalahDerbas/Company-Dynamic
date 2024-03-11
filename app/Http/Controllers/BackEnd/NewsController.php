<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use Str;

class NewsController extends Controller
{
    
    public function index()
    {
        $newss = News::orderBy('id','desc')->get();
        return view('backEnd.view-news',compact('newss'));
    }

    
    public function create()
    {
        $languages  = Language::orderBy('id','desc')->get();
        $categories = Category::orderBy('id','desc')->get();
        return view('backEnd.view-news-create',compact('languages','categories'));
    }

    
    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $request['slug'] = Str::slug($request['slug'],'-');
        $this->validate($request,[
            'title'         => 'required|string',
            'slug'          => 'required|string|unique:news',
            'short_content' => 'required|string',
            'content'       => 'required|string',
            'news_date'     => 'required|date',
            'category'      => 'required|string',
            'comment'       => 'required|string',
            'photo'         => 'required|image',
            'banner'        => 'required|image',
        ]);


        /* start image part */
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'news_photo_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
        }
        /* end image part */

        /* start banner part */
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannername = 'news_banner_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$bannername);
        }
        /* end banner part */

        News::create([
            'title'            => $request->title,
            'slug'             => Str::slug($request->slug),
            'short_content'    => $request->short_content,
            'content'          => $request->content,
            'news_date'        => date('Y-m-d',strtotime($request->news_date)),
            'category_id'      => $request->category,
            'comment'          => $request->comment,
            'photo'            => $filename,
            'banner'           => $bannername,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'lang_id'          => $request->lang_id,
        ]);

        notify()->success(A_SUCCESS_DATA_ADD, A_SUCCESS);
        return redirect()->route('news.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $languages   = Language::orderBy('id','desc')->get();
        $categories = Category::orderBy('id','desc')->get();

        return view('backEnd.view-news-edit',compact('news','languages','categories'));
    }

    
    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $news = News::findOrFail($id);
        $request['slug'] = Str::slug($request['slug'],'-');
        $this->validate($request,[
            'title'         => 'required|string',        
            'slug'          => 'required|string|unique:news,slug,'.$news->id,
            'short_content' => 'required|string',
            'content'       => 'required|string',
            'news_date'     => 'required',
            'category'      => 'required|string',
            'comment'       => 'required|string',
            'photo'         => 'image',
            'banner'        => 'image',
        ]);

        /* start image part */
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/'.$news->photo));
            $filename = 'news_photo_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $news['photo'] = $filename;
        }
        /* end image part */

        /* start image part */
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            @unlink(public_path('upload/'.$news->banner));
            $bannername = 'news_banner_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$bannername);
            $news['banner'] = $bannername;
        }
        /* end image part */

        $news->title            = $request->title;
        $news->slug             = Str::slug($request->slug);
        $news->short_content    = $request->short_content;
        $news->content          = $request->content;
        $news->news_date        = date('Y-m-d',strtotime($request->news_date));
        $news->category_id      = $request->category;
        $news->comment          = $request->comment;
        $news->meta_title       = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->lang_id          = $request->lang_id;
        $news->update();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->route('news.index');
    }

    
    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $news = News::findOrFail($id);
            if (file_exists(public_path('upload/' . $news->photo)) AND ! empty($news->photo)) {
                unlink(public_path('upload/' . $news->photo));
            }
            if (file_exists(public_path('upload/' . $news->banner)) AND ! empty($news->banner)) {
                unlink(public_path('upload/' . $news->banner));
            }
        $news->delete();

        notify()->success(A_SUCCESS_DATA_DELETE, A_SUCCESS);
        return back();
    }

    public function comment()
    {
        $commet = Comment::orderBy('id','desc')->first();
        return view('backEnd.view-news-comment',compact('commet'));
    }

    public function commentUpdate(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $commet = Comment::findOrFail($id);
        $commet->update([
            'code_body' => $request->code_body
        ]);
        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return back();
    }
}
