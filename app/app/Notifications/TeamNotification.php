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
    private $teamUrl;
    private $teamName;

    /**
     * Create a new notification instance.
     *
     * @param string $addedUserName
     * @param string $addedByUserName
     * @param string $addedDateTime
     */
    public function __construct($addedUserName, $addedByUserName, $addedDateTime, $teamUrl, $teamName)
    {
        $this->addedUserName = $addedUserName;
        $this->addedByUserName = $addedByUserName;
        $this->addedDateTime = $addedDateTime;
        $this->teamUrl = $teamUrl;
        $this->teamName = $teamName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Nouvelle personne ajoutée à l\'équipe ' . $this->teamName . ' !')
            ->line('Nom de l\'utilisateur ajouté: ' . $this->addedUserName)
            ->line('Ajouté par: ' . $this->addedByUserName)
            ->line('Date et heure de l\'ajout: ' . $this->addedDateTime)
            ->action('Voir l\'équipe', url($this->teamUrl))
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
            'type' => 'addPersonToTeam',
            'message' => $this->addedUserName . ' a été ajouté par ' . $this->addedByUserName . ' à l\'équipe ' . $this->teamName . ' à . ' . $this->addedDateTime . ' !',
        ];
    }
}

// - **mail** avec son contenu provenant d'un fichier de traduction avec les informations suivantes:
//     - nom de l'utilisateur ajouté
//     - nom de l'utilisateur ayant ajouté
//     - date heure de l'ajout
