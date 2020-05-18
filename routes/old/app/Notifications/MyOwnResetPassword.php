<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MyOwnResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token=0)
    {
        //
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
	                ->subject('Reset Password')
	                ->greeting('Backoffice')
	                ->line('Estas recibiendo este email porque hemos recibido una peticion de reinicio de contraseña de tu cuenta.')
	                ->action('Reiniciar contraseña', url('password/reset/'.$this->token, false))
	                ->line('Si tu no has solicitado el reinicio, no necesitas hacer ninguna acción.')
	                ;
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
