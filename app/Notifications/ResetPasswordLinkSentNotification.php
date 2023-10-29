<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordLinkSentNotification extends Notification
{
    use Queueable;

    protected $token;
    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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

        $url = route('password.reset-copie', ['token' => $this->token, 'email' => $notifiable->email]);

        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Solicitud Aceptada')
            ->greeting('Hola ' . $notifiable->name . ', esperamos que te encuentres bien.')
            ->line('Nos complace informarte que tu solicitud de trabajo ha sido aceptada en Govin. Felicitaciones por superar nuestro riguroso proceso de selección y por unirte a nuestro equipo.')
            ->line('Para finalizar tu incorporación, te pedimos que sigas estos sencillos pasos:')
            ->line('Paso 1: Configura tu contraseña')
            ->line('Ahora que has sido aceptado, es importante que establezcas una contraseña segura para acceder a nuestra plataforma interna. Por favor, presione el botón (Continuar) y elige una contraseña que cumpla con nuestras políticas de seguridad.')
            ->line('Paso 2: Accede a tu cuenta')
            ->line('Una vez que hayas configurado tu contraseña, podrás acceder a tu cuenta en nuestro sistema interno. Allí encontrarás información importante sobre tu nuevo rol, documentos relevantes y otros recursos útiles.')
            ->action('Continuar', $url)
            ->line('Si no hiciste esta peticion ignora el mensaje.')
            ->salutation('Gracias.')
            ->markdown('vendor.notifications.trabajoEmail'); // Esto asume que tienes una plantilla Markdown personalizada que renderiza el botón con estilos
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
