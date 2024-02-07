<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamNotification extends Notification
{
    use Queueable;

    private $userAdded;
    private $userAddedBy;
    private $datetime;
    private $team;
    private $teamUrl;

    public function __construct(string $userAdded, string $userAddedBy, string $team, string $teamUrl, string $datetime)
    {
        $this->userAdded = $userAdded;
        $this->userAddedBy = $userAddedBy;
        $this->team = $team;
        $this->teamUrl = $teamUrl;
        $this->datetime = $datetime;
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
            ->line(__('notifications.intro') . ' ' . $this->team)
            ->line(__('notifications.user_added') . ' ' . $this->userAdded)
            ->line(__('notifications.added_to') . ' ' . $this->team)
            ->line(__('notifications.added_by') . ' ' . $this->userAddedBy)
            ->line(__('notifications.added_at') . ' ' . $this->datetime)
            ->action(__('notifications.see_more'), url($this->teamUrl));
    }

    /**
     * Get the array representation of the notification.
     *
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => __('notifications.log') . ' ' . $this->team,
            'added_user_name' => $this->userAdded,
            'added_by_user_name' => $this->userAddedBy,
            'added_datetime' => $this->datetime,
        ];
    }
}
?>