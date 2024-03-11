<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PageSearch;
use App\Models\News;
use App\Models\LanguageDetail;
use App\Models\Language;
use Session;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            if(!session()->get('session_lang_id')) {
                Session::put('session_lang_id',2);
            }
            $language_details = LanguageDetail::where('lang_id',session('session_lang_id'))->get();
            foreach($language_details as $row) {
                define($row->lang_string, $row->lang_string_value);
            };
            return $next($request);
        });
    }

    public function getData(Request $request)
    {
        $data['search'] = $request['search_string'];

        $search = $request['search_string'] ?? '';
        if ($search != "") {
            $data['news'] = News::where('lang_id',session('session_lang_id'))
                                ->where('title','LIKE',"%$search%")
                                ->orWhere('content','LIKE',"%$search%")
                                ->orderBy('id','desc')->get();
        } else {
           $data['news'] = News::where('lang_id',session('session_lang_id'))
                                ->orderBy('id','desc')->get();
        }
        $data['page_search'] = PageSearch::where('lang_id',session('session_lang_id'))->first();

        return view('frontEnd.view-search',$data);
    }
}
