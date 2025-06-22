<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verifyUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email - Perpustakaan Digital SMP N 12 Yogyakarta')
            ->greeting('Halo, ' . $notifiable->name . ' 👋')
            ->line('Selamat datang di Sistem Informasi Perpustakaan Digital SMP Negeri 12 Yogyakarta.')
            ->line('Untuk mengaktifkan akun Anda, silakan lakukan verifikasi email dengan menekan tombol di bawah ini.')
            ->action('Verifikasi Sekarang', $verifyUrl)
            ->line('Jika Anda tidak merasa mendaftar akun, abaikan email ini.')
            ->salutation('Salam hangat, Tim Perpustakaan SMP N 12 Yogyakarta');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
