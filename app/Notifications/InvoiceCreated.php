<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;


class InvoiceCreated extends Notification
{
    use Queueable;

private $invoice;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        
        $this->invoice = $invoice;

            }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
           return ['firebase'];
    }

   
    /**
     * Get the firebase representation of the notification.
     */
    public function toFirebase($notifiable)
    {
       if($notifiable->device_key){

        $x = (new FirebaseMessage)
            ->withTitle('New Order, ', $notifiable->first_name)
            ->withBody('Hello You Have a New Order')
            ->asNotification([$notifiable->device_key]);

            dd($x->body());
            return true;
       }

      
      
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
