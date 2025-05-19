<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuspiciousCertificateActivity extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ipAddress;
    protected $attemptCount;

    public function __construct($ipAddress, $attemptCount)
    {
        $this->ipAddress = $ipAddress;
        $this->attemptCount = $attemptCount;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Activité suspecte de vérification de certificats')
            ->line('Une activité suspecte a été détectée dans le système de vérification des certificats.')
            ->line("L'adresse IP {$this->ipAddress} a effectué {$this->attemptCount} tentatives de vérification dans les dernières 24 heures.")
            ->action('Voir les détails', route('admin.certificates.verifications.index'))
            ->line('Il est recommandé de vérifier ces activités pour s\'assurer qu\'il ne s\'agit pas d\'une tentative d\'abus du système.');
    }

    public function toArray($notifiable)
    {
        return [
            'ip_address' => $this->ipAddress,
            'attempt_count' => $this->attemptCount,
            'type' => 'suspicious_certificate_activity'
        ];
    }
}