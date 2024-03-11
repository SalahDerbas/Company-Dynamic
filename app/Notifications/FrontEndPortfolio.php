<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FrontEndPortfolio extends Notification
{
    use Queueable;

    public $portfolio;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($portfolio)
    {
        $this->portfolio = $portfolio;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Portfolio Form')
                    ->line('Name: '.$this->portfolio['name'])
                    ->line('Phone: '.$this->portfolio['phone'])
                    ->line('Email Address: '.$this->portfolio['email'])
                    ->line('Message: '.$this->portfolio['message'])
                    ->line('Portfolio Name: '.$this->portfolio['portfolio'])
                    ->action('View', url(route('portfolio.view',$this->portfolio['slug'])));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
