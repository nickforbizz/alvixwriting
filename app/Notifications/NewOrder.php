<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;
    protected $publisher;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->publisher = $publisher;
        // $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            // 'publisher' => $this->publisher->id,
            'publisher' => '1',
            // 'publisher_name' => $this->publisher->fname,
            'publisher_name' => 'nicholas',
            // 'order_id' => $this->order->id,
            'order_id' => 'How the world war affected china',
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
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'publisher' => $this->publisher->id,
                'publisher_name' => $this->publisher->fname,
                'order_id' => $this->order->id,
            ],
        ];
    }


}
