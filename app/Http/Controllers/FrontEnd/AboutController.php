<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageAbout;
use App\Models\LanguageDetail;
use App\Models\Language;
use Session;

class AboutController extends Controller
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

    public function index()
    {
        $data['page_about'] = PageAbout::where('lang_id',session()->get('session_lang_id'))->first();

        return view('frontEnd.view-about',$data);
    }
}
