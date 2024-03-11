<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LanguageDetail;
use App\Models\Language;
use App\Models\PageContact;
use App\Rules\Captcha;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FrontEndContact;
use Session;

class ContactController extends Controller
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
        $data['page_contact'] = PageContact::where('lang_id',session()->get('session_lang_id'))->first();

        return view('frontEnd.view-contact',$data);
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
            'subject' => 'required|string',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required'
        ], [
            'name.required' => ERROR_EMPTY_NAME,
            'email.required' => ERROR_EMPTY_EMAIL,
            'email.email' => ERROR_INVALID_EMAIL,
            'phone.required' => ERROR_EMPTY_PHONE,
            'subject.required' => ERROR_EMPTY_SUBJECT,
            'message.required' => ERROR_EMPTY_MESSAGE,
            'g-recaptcha-response.required' => ERROR_INCORRECT_CAPTCHA
        ]);

        if(!$validator->passes())
        {
            return response()->json(['code'=>0,'error_message'=>$validator->errors()->toArray()]);
        }
        else
        {
            $contact = $request->all();
            $users = User::where('role','Admin')->get();

            Notification::send($users, new FrontEndContact($contact));
            return response()->json(['code'=>1,'success_message'=>SUCCESS_CONTACT_FORM]);
        }
    }
}
