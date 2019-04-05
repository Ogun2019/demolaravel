<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class modificationAction extends Notification implements ShouldQueue {

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     * @param valeur pour déterminer si la notification est en temps réel ou non..
     */
    public $user;
    public $id;

    public function __construct($user, $id,$param) {
        if ($param == "0") {
            $this->user = $user;
            $this->id = $id;
        } else {
            $this->id = $id;
            $this->user = $user;
            $when = new \DateTime();
            $when->setTime(9,00);
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
        return (new MailMessage)
                        ->line('Une action a été modifié !')
                        ->action('Cliquez pour voir', url('/home'))
                        ->line('Cette modification a été fait par : ' . $nom = $this->user->name . "\n identifiant :" . $id = $this->user->id)
                        ->line('Identifiant de l\'action modifié :' . $this->id);
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
