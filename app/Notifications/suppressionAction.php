<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class suppressionAction extends Notification implements ShouldQueue {

    use Queueable;

    /**
     * Create a new notification instance.
     *verifie si l'utilisateur souhaite recevoir les notification en temps réel
     * @return void
     */
    public $id;
    public function __construct($id, $param) {
        if ($param == "0") {
            $this->id = $id;
        } else {
            $this->id = $id;
            $when = new \DateTime();
            $when->setTime(9, 00);
            $when->modify('+1 day');
            $this->delay($when);
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $id = $this->id;
        return (new MailMessage)
                        ->line('Une action a été supprimé !')
                        ->line('identifiant de l\'action : '. $id);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
                //
        ];
    }

}
