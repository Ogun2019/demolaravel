<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;

class nouveauCommentaire extends Notification implements ShouldQueue {

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $idExp;
    public $idAction;

    public function __construct($idExp, $idAction) {
        $this->idExp = $idExp;
        $this->idAction = $idAction;
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
        $user = User::find($this->idExp)->name;
        return (new MailMessage)
                        ->line('Nouveau commentaire par ' . $user)
                        ->action('Voir ce commentaire', redirect()->action('AchatDetailsController@showComment', [$this->idAction]))
                        ->line('Maxi Toys');
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
