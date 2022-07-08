<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VehicleActivated extends Notification
{
    use Queueable;

    private $vehicle;

    /**
     * Create a new notification instance.
     *
     * @param $vehicle
     */
    public function __construct($vehicle)
    {
        //
        $this->vehicle = $vehicle;
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
                    ->subject('Nuevo Vehículo')
                    ->greeting('Hola!')
                    ->line('Hemos agregado un vehículo a nuestro catálogo, que te puede interesar. Haz click en el siguiente botón para verlo!')
                    ->action('Ver Vehículo!', route('vehicle.show', $this->vehicle->id))
                    ->line('Gracias por confiar en nosotros!')
                    ->salutation('Saludos, Maneja!');
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
