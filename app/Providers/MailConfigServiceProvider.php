<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Config;
use Illuminate\Support\Facades\DB;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (\Schema::hasTable('settings')) {
            $mail = DB::table('settings')->orderBy('id','desc')->first();

            if ($mail) {
                $config = array(
                    'driver'     => $mail->mail_mailer,
                    'host'       => $mail->mail_host,
                    'port'       => $mail->mail_port,
                    'from'       => array(
                                        'address' => $mail->mail_from_address, 
                                        'name'    => $mail->mail_from_name),
                    'encryption' => $mail->mail_encryption,
                    'username'   => $mail->mail_username,
                    'password'   => $mail->mail_password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
