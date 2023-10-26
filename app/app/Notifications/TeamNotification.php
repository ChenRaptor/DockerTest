<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamNotification extends Notification
{
    use Queueable;

    private $addedUserName;
    private $addedByUserName;
    private $addedDateTime;

    /**
     * Create a new notification instance.
     *
     * @param string $addedUserName
     * @param string $addedByUserName
     * @param string $addedDateTime
     */
    public function __construct($addedUserName, $addedByUserName, $addedDateTime)
    {
        $this->addedUserName = $addedUserName;
        $this->addedByUserName = $addedByUserName;
        $this->addedDateTime = $addedDateTime;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Nouvelle personne ajoutée à l\'équipe')
            ->line('Nom de l\'utilisateur ajouté: ' . $this->addedUserName)
            ->line('Ajouté par: ' . $this->addedByUserName)
            ->line('Date et heure de l\'ajout: ' . $this->addedDateTime)
            ->action('Voir l\'équipe', url('/'))
            ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Nouvelle personne ajoutée à l\'équipe',
            'added_user_name' => $this->addedUserName,
            'added_by_user_name' => $this->addedByUserName,
            'added_datetime' => $this->addedDateTime,
        ];
    }
}

// - **mail** avec son contenu provenant d'un fichier de traduction avec les informations suivantes:
//     - nom de l'utilisateur ajouté
//     - nom de l'utilisateur ayant ajouté
//     - date heure de l'ajout
