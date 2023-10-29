<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserResetPassword extends Notification
{
    use Queueable;
    protected $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token=$token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Restablecer contraseña')
                    ->greeting('Hola ' . $notifiable->name . ', esperamos que te encuentres bien.')
                    ->line('Recibiste este correo electrónico porque solicitaste restablecer tu contraseña.')
                    ->action('Restablecer contraseña', route('password.reset', ['token' => $this->token, 'email' => $notifiable->email]))
                    ->line('Si no hiciste esta petición, no es necesario realizar ninguna acción.')
                    ->salutation('Gracias por utilizar nuestro servicio.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
