<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Artisan;
use Hash;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::orderBy('id','desc')->first();
        return view('backEnd.view-setting',compact('setting'));
    }

    public function logoUpdate(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $setting = Setting::findOrFail($id);

        /* start image part */
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            @unlink(public_path('upload/'.$setting->logo));
            $filename = 'logo_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['logo'] = $filename;
        }
        /* end image part */
        $setting->update();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->back();
    }

    public function faviconUpdate(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $setting = Setting::findOrFail($id);

        /* start image part */
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            @unlink(public_path('upload/'.$setting->favicon));
            $filename = 'favicon_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['favicon'] = $filename;
        }
        /* end image part */
        $setting->update();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->back();
    }


    public function bannerUpdate(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $setting = Setting::findOrFail($id);

        if ($request->hasFile('banner_about')) {
            $file = $request->file('banner_about');
            @unlink(public_path('upload/'.$setting->banner_about));
            $filename = 'banner_about_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_about'] = $filename;
        }

        if ($request->hasFile('banner_testimonial')) {
            $file = $request->file('banner_testimonial');
            @unlink(public_path('upload/'.$setting->banner_testimonial));
            $filename = 'banner_testimonial_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_testimonial'] = $filename;
        }

        if ($request->hasFile('banner_news')) {
            $file = $request->file('banner_news');
            @unlink(public_path('upload/'.$setting->banner_news));
            $filename = 'banner_news_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_news'] = $filename;
        }

        if ($request->hasFile('banner_event')) {
            $file = $request->file('banner_event');
            @unlink(public_path('upload/'.$setting->banner_event));
            $filename = 'banner_event_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_event'] = $filename;
        }

        if ($request->hasFile('banner_contact')) {
            $file = $request->file('banner_contact');
            @unlink(public_path('upload/'.$setting->banner_contact));
            $filename = 'banner_contact_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_contact'] = $filename;
        }

        if ($request->hasFile('banner_search')) {
            $file = $request->file('banner_search');
            @unlink(public_path('upload/'.$setting->banner_search));
            $filename = 'banner_search_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_search'] = $filename;
        }

        if ($request->hasFile('banner_privacy')) {
            $file = $request->file('banner_privacy');
            @unlink(public_path('upload/'.$setting->banner_privacy));
            $filename = 'banner_privacy_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_privacy'] = $filename;
        }

        if ($request->hasFile('banner_verify_subscriber')) {
            $file = $request->file('banner_verify_subscriber');
            @unlink(public_path('upload/'.$setting->banner_verify_subscriber));
            $filename = 'banner_verify_subscriber_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_verify_subscriber'] = $filename;
        }

        if ($request->hasFile('banner_faq')) {
            $file = $request->file('banner_faq');
            @unlink(public_path('upload/'.$setting->banner_faq));
            $filename = 'banner_faq_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_faq'] = $filename;
        }

        if ($request->hasFile('banner_service')) {
            $file = $request->file('banner_service');
            @unlink(public_path('upload/'.$setting->banner_service));
            $filename = 'banner_service_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_service'] = $filename;
        }

        if ($request->hasFile('banner_portfolio')) {
            $file = $request->file('banner_portfolio');
            @unlink(public_path('upload/'.$setting->banner_portfolio));
            $filename = 'banner_portfolio_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_portfolio'] = $filename;
        }

        if ($request->hasFile('banner_team')) {
            $file = $request->file('banner_team');
            @unlink(public_path('upload/'.$setting->banner_team));
            $filename = 'banner_team_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_team'] = $filename;
        }

        if ($request->hasFile('banner_pricing')) {
            $file = $request->file('banner_pricing');
            @unlink(public_path('upload/'.$setting->banner_pricing));
            $filename = 'banner_pricing_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_pricing'] = $filename;
        }

        if ($request->hasFile('banner_photo_gallery')) {
            $file = $request->file('banner_photo_gallery');
            @unlink(public_path('upload/'.$setting->banner_photo_gallery));
            $filename = 'banner_photo_gallery_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_photo_gallery'] = $filename;
        }

        if ($request->hasFile('banner_terms')) {
            $file = $request->file('banner_terms');
            @unlink(public_path('upload/'.$setting->banner_terms));
            $filename = 'banner_terms_'.md5(mt_rand(11111111,99999999)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload'),$filename);
            $setting['banner_terms'] = $filename;
        }

        $setting->update();

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->back();
    }



    public function textItemsUpdate(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $setting = Setting::findOrFail($id);

        if ($request->top_bar_email || $request->top_bar_phone != null) {
            $setting->update([
                'top_bar_email' => $request->top_bar_email,
                'top_bar_phone' => $request->top_bar_phone,
            ]);
        }

        if ($request->mail_mailer || $request->mail_encryption || $request->mail_host || $request->mail_port || $request->mail_username || $request->mail_password || $request->mail_from_address || $request->mail_from_name != null) {

            $setting->update([
                'mail_mailer'       => 'smtp',
                'mail_encryption'   => $request->mail_encryption,
                'mail_host'         => $request->mail_host,
                'mail_port'         => $request->mail_port,
                'mail_username'     => $request->mail_username,
                'mail_password'     => $request->mail_password,
                'mail_from_address' => $request->mail_from_address,
                'mail_from_name'    => $request->mail_from_name,
            ]);

        }


        if ($request->sidebar_total_recent_post || $request->sidebar_total_upcoming_event || $request->sidebar_total_past_event != null) {
            $setting->update([
                'sidebar_total_recent_post' => $request->sidebar_total_recent_post,
                'sidebar_total_upcoming_event' => $request->sidebar_total_upcoming_event,
                'sidebar_total_past_event' => $request->sidebar_total_past_event,
            ]);
        }


        if ($request->google_recaptcha_key || $request->google_recaptcha_secret || $request->google_recaptcha_status != null) {
            $this->validate($request,[
                'google_recaptcha_key'    => 'required|string',
                'google_recaptcha_secret' => 'required|string',
                'google_recaptcha_status' => 'required|string',
            ]);

            $setting->update([
                'google_recaptcha_key'    => $request->google_recaptcha_key,
                'google_recaptcha_secret' => $request->google_recaptcha_secret,
                'google_recaptcha_status' => $request->google_recaptcha_status,
            ]);
        }


        if ($request->language_status != null) {
            $setting->update([
                'language_status' => $request->language_status,
            ]);
        }

        if ($request->website_name || $request->tawk_live_chat_code || $request->tawk_live_chat_status != null) {
            $setting->update([
                'website_name' => $request->website_name,
                'tawk_live_chat_code' => $request->tawk_live_chat_code,
                'tawk_live_chat_status' => $request->tawk_live_chat_status,
            ]);

            Artisan::call("env:set APP_NAME='". $request->get('website_name') ."'");
        }

        if ($request->front_end_color != null) {
            $setting->update([
                'front_end_color' => $request->front_end_color,
            ]);
        }

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->back();
    }

}