<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetsPassword;

class CustomResetPassword extends Notification
{
    use Queueable;

    /**
     * The Password reset token.
     *
     * @var string
    */
    public $token;


    /**
     * Create a new notification instance.
     *
     * @param string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
           ->subject('パスワード再設定')
           ->line('以下のリンクをクリックしてパスワードを再設定してください。')
           ->action('パスワード再設定', url(route('password.reset', $this->token, false)))
           ->line('上記リンクへのアクセス有効期限は60分です。')
           ->line('もし本メッセージに心当たりがない場合は、当メールを破棄してください。');
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
