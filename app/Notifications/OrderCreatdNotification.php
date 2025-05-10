<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;


class OrderCreatdNotification extends Notification
{
    use Queueable;
    protected $order;

    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject('Order Created Successfully | #' . $this->order->number)
            ->line('The introduction to the notification.')
            ->action('Visit websit', url(env('APP_URL')))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the databse representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'body'          => 'Order Created Successfully | #' . $this->order->number,
            'icon'          => 'nav-icon bi bi-house-gear-fill',
            'link'          => url(env('APP_URL'))
        ];
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
