<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SolicitudAceptadaNotification extends Notification
{
    use Queueable;
    protected $nombrePropietario;
    /**
     * Create a new notification instance.
     */
    public function __construct($nombrePropietario)
    {
        $this->nombrePropietario = $nombrePropietario;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Solicitud Aceptada')
            ->greeting('Hola ' . $this->nombrePropietario . ', esperamos que te encuentres bien.')
            ->line('Nos complace informarte que tu solicitud para unirte a GoVin como negocio de entrega ha sido aceptada. Felicitaciones por unirte a nuestra plataforma y formar parte de nuestro equipo.')
            ->line('Para comenzar, presiona ya mismo el botón (Continuar) e inicia sesión y mirá tu negocio en nuestra plataforma.')
            ->action('Continuar', url('dashboard'))
            ->line('Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos. Estamos aquí para apoyarte en el proceso de incorporación.')
            ->line('¡Te damos la bienvenida a GoVin y te deseamos mucho éxito en tu negocio!')
            ->salutation('Gracias por confiar en nosotros.')
            ->markdown('vendor.notifications.trabajoEmail');
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
