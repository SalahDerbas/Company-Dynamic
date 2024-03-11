<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagePricing;
use App\Models\PricingTable;
use App\Models\LanguageDetail;
use App\Models\Language;
use Session;

class PricingController extends Controller
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
        $data['page_pricing'] = PagePricing::where('lang_id',session()->get('session_lang_id'))->first();
        $data['pricing_tables'] = PricingTable::where('lang_id',session()->get('session_lang_id'))->get();

        return view('frontEnd.view-pricing',$data);
    }
}
