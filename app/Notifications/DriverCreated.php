<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Driver;

class DriverCreated extends Notification
{
    use Queueable;

    protected $password;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password, $user)
    {
        $this->password = $password;
        $this->user = $user;
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
                ->greeting(__('notications.hello',['username' => $this->user->name]))
                ->line(__('notications.driver_acc_created',['app_name' => env('APP_NAME',"")]))
                ->action('notications.login', url(env('APP_URL',"")."/login"))
                ->line(__('notications.username',['email'=>$this->user->email]))
                ->line(__('notications.password',['password'=>$this->password]))
                ->line(__('notications.reset_pass'));
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
