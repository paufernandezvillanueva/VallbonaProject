<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class MyResetPassword extends ResetPassword
{

    public function __construct($token)
    {
        $this->token = $token;
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(Lang::get('Notificació de restabliment de contrasenya'))
            ->line(Lang::get('Esteu rebent aquest correu electrònic perquè hem rebut una sol·licitud de restabliment de contrasenya per al vostre compte.'))
            ->action(Lang::get('Reiniciar contrasenya'), route("password.reset", ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]))
            ->line(Lang::get('Aquest enllaç de restabliment de contrasenya caducarà en :count minuts.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Si no heu sol·licitat un restabliment de contrasenya, no cal prendre cap mesura addicional.'));
    }
}