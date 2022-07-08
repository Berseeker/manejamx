<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactForm extends Notification
{
    use Queueable;

    private $name;
    private $phone;
    private $email;
    private $message;
    private $from_calculator;
    private $calculator_inputs;

    /**
     * Create a new notification instance.
     *
     * @param $name
     * @param $phone
     * @param $email
     * @param $message
     * @param bool $from_calculator
     * @param null $calculator_inputs
     */
    public function __construct($name, $phone, $email, $message, $from_calculator = false, $calculator_inputs = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->message = $message;
        $this->from_calculator = $from_calculator;
        $this->calculator_inputs = $calculator_inputs;
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
        $notification = (new MailMessage)
            ->subject('Nuevo formulario de contacto.')
            ->greeting('Hola!')
            ->line(
                'Nombre: ' . $this->name . ' Teléfono: ' . $this->phone . ' Email: ' . $this->email
            )
            ->line($this->message);

        if ($this->from_calculator) {
            $inputs = json_decode($this->calculator_inputs);

            $notification->line(
                'Este contacto vino desde la calculadora.'
            )->line(
                'Año de la unidad: ' . $inputs->year . ' Valor de la unidad: $' .  $inputs->vehicle_price . ' Depósito: $' . $inputs->load_deposit . ' Plazo: ' . $inputs->loan_installments . ' meses'
            );
        }

        return $notification;
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
