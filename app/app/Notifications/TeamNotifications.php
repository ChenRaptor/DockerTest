<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamNotifications extends Notification
{
    use Queueable;

    private $addedUser;
    private $addedBy;
    private $addedTime;
    private $joinedTeam;
    private $url;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $addedUser, string $addedBy, string $addedTime, string $joinedTeam, string $url)
    {
        $this->addedUser = $addedUser;
        $this->addedBy = $addedBy;
        $this->addedTime = $addedTime;
        $this->joinedTeam = $joinedTeam;
        $this->url = $url;
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
                    ->line("Un $this->addedUser sauvage arrive dans $this->joinedTeam.")
                    ->line("$this->addedBy l'a ajouté à $this->addedTime.")
                    ->action('Voir la team', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'addedUser' => $this->addedUser,
            'addedBy' => $this->addedBy,
            'added_time' => $this->addedTime,
        ];
    }
}