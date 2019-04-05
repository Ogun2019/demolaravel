<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use DB;

class ajoutAction extends Notification implements ShouldQueue {

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $idaction;
    public function __construct($idact,$param) {
        if ($param == "0") {
            $this->idaction = $idact;
        }else{
            $this->idaction = $idact;
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
        return (new MailMessage)
                        ->line('Une nouvelle action a été ajouté !')
                        ->action('Cliquez pour voir', url('/home'))
                        ->line('identifiant de l\'action : ' . $id = $this->idaction);
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
