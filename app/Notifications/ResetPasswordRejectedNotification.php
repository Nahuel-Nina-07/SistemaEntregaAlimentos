<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordRejectedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Solicitud Rechazada')
            ->greeting('Hola, esperamos que te encuentres bien.')
            ->line('Queremos agradecerte sinceramente por tu interés en unirse a GoVin y por tomarte el tiempo para enviar tu solicitud. Valoramos y apreciamos el esfuerzo que pusiste en tu solicitud. Lamentablemente, después de un proceso de revisión minucioso y consideración cuidadosa, hemos tomado la decisión de no avanzar con tu solicitud en esta ocasión.')
            ->line('Agradecemos nuevamente tu interés en GoVin y te deseamos mucho éxito en tus futuras búsquedas laborales. Si tienes alguna pregunta o necesitas comentarios adicionales sobre tu solicitud, no dudes en contactarnos. Estamos aquí para ayudarte. Gracias nuevamente y te enviamos nuestros mejores deseos.')
            ->salutation('Atentamente, Equipo de GoVin');
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
