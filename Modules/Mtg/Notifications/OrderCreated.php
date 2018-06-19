<?php

namespace Modules\Mtg\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Mtg\Entities\MtgOrder;


class OrderCreated extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MtgOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable){

        $total = 0;
        foreach ($this->order->items as $item){
            $total = $total + ($item->quantity * $item->cardPrice);
        }

        $total = $total + $this->order->shipping_cost;
        $total = $total + $this->order->handling_cost;

        return (new MailMessage)->markdown('mtg::email.order-created', ['order' => $this->order, 'total' => $total]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
