<?php

namespace App\Notifications;


use App\Models\Team;
use App\Models\User;
use Edujugon\PushNotification\Channels\FcmChannel;
use Edujugon\PushNotification\Messages\PushMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserLoggedInNotifyTeam extends BaseGameNotification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', FcmChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray(Team $notifiable)
    {
        return [
            'message' => $this->user->name,
            'team' => [
                'name' => $notifiable->name,
            ],
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast(Team $notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    /**
     * @param $notifiable
     * @return $this
     */
    public function toFcm(Team $notifiable)
    {
        return (new PushMessage)
            ->title(__('notifications.user_logged_in_notify_team', ['name' => $this->user->name]));
    }
}