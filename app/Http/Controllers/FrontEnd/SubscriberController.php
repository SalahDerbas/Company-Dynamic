<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\Setting;
use App\Models\LanguageDetail;
use Hash;
use Mail;
use App\Exports\SubscriberExport;
use Excel;
use DB;

class SubscriberController extends Controller
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
    
    public function store(Request $request)
    {        
        $validator = \Validator::make($request->all(),[
            'email' => 'required|email|unique:subscribers',
        ], [
            'email.required' => ERROR_EMPTY_EMAIL,
            'email.email' => ERROR_INVALID_EMAIL,
            'email.unique' => ERROR_EXIST_EMAIL
        ]);

        if(!$validator->passes()) {
            return response()->json(['code'=>0,'error_message'=>$validator->errors()->toArray()]);
        } else {
            $subscriber = new Subscriber();
            $subscriber->email  = $request->email;
            $subscriber->token  = hash('sha256',time());
            $subscriber->status = 0;
            $subscriber->save();

            $data = array(
                'id'    => $subscriber->id,
                'email' => $request->email,
                'token' => $subscriber->token,
            );

            Mail::send('frontEnd.mails.verify-email',$data, function($message) use($data) {
                $setting_data = Setting::where('id',1)->first();
                $mail_from_address = $setting_data->mail_from_address;
                $mail_from_name = $setting_data->mail_from_name;
                $message->from($mail_from_address,$mail_from_name);
                $message->to($data['email']);
                $message->subject('Verify Subscriber');
            });
            return response()->json(['code'=>1,'success_message'=>SUCCESS_SUBSCRIPTION_FORM]);
        }

    }


    public function verify($token)
    {
        if (!is_null($token)) {
            $subscriber = Subscriber::where('token',$token)->first();

            if (!is_null($subscriber)) {
                $subscriber->status = 1;
                $subscriber->token = '';
                $subscriber->save();
                notify()->success(SUCCESS_SUBSCRIBER_VERIFICATION, "Success");
                return redirect()->route('home.page');
            }else{
                notify()->error(ERROR_SUBSCRIBER_VERIFICATION, "Error");
               return redirect()->route('home.page');
            }

        } else {
           return redirect()->route('home.page'); 
        }
    }

    public function pending()
    {
        $subscribers = Subscriber::where('status',0)->get();

        foreach ($subscribers as $subscriber) {
            $subscriber->delete();
        }

        notify()->success("Pending subscribers are deleted", "Success");
        return redirect()->back();
    }

    public function exportIntoCSV()
    {
        return Excel::download(new SubscriberExport,'subscriberlist.csv');
    }
}