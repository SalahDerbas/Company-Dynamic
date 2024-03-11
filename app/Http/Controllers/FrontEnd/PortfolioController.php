<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Portfolio;
use App\Models\PagePortfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioPhoto;
use App\Models\LanguageDetail;
use App\Models\Language;
use App\Models\User;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FrontEndPortfolio;
use Session;

class PortfolioController extends Controller
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
        $data['page_portfolio']    = PagePortfolio::where('lang_id',session()->get('session_lang_id'))->first();
        $data['portfolio_categories'] = PortfolioCategory::where('lang_id',session()->get('session_lang_id'))->get();

        return view('frontEnd.view-portfolio',$data);
    }

    public function view($slug)
    {
        $data['portfolio']  = Portfolio::where('lang_id',session()->get('session_lang_id'))->where('slug',$slug)->first();
        if (isset($data['portfolio']->slug)) {
            $data['all_news']  = News::all();
            $data['portfolios'] = Portfolio::all();
            
            $data['page_portfolio']    = PagePortfolio::where('lang_id',session()->get('session_lang_id'))->first();
            $data['portfolio_categories'] = PortfolioCategory::where('lang_id',session()->get('session_lang_id'))->get();
            $data['portfolio_photos'] = PortfolioPhoto::where('portfolio_id',$data['portfolio']->id)->get();
            $data['portfolio_order_by_name'] = Portfolio::where('lang_id',session()->get('session_lang_id'))->orderBy('name','asc')->get();

            return view('frontEnd.view-portfolio-detail',$data);
        }else{
            return back();
        }
    }

    public function sendEmail(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return response()->json(['code'=>2,'success_message'=>env('PROJECT_NOTIFICATION')]);
        }
        
        $validator = \Validator::make($request->all(),[
            'name'=>'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required'
        ], [
            'name.required' => ERROR_EMPTY_NAME,
            'email.required' => ERROR_EMPTY_EMAIL,
            'email.email' => ERROR_INVALID_EMAIL,
            'phone.required' => ERROR_EMPTY_PHONE,
            'message.required' => ERROR_EMPTY_MESSAGE,
            'g-recaptcha-response.required' => ERROR_INCORRECT_CAPTCHA
        ]);

        if(!$validator->passes())
        {
            return response()->json(['code'=>0,'error_message'=>$validator->errors()->toArray()]);
        }
        else
        {
            $portfolio = $request->all();
            $users = User::where('role','Admin')->get();

            Notification::send($users, new FrontEndPortfolio($portfolio));
            return response()->json(['code'=>1,'success_message'=>SUCCESS_PORTFOLIO_PAGE_FORM]);
        }
    }
}
