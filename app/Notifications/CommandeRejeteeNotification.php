<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class CommandeRejeteeNotification extends Notification
{
    use Queueable;

    protected $commande;
    protected $raison;

    public function __construct($commande, $raison)
    {
        $this->commande = $commande;
        $this->raison = $raison;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Commande rejetée')
            ->greeting('Bonjour ' . $notifiable->nom)
            ->line("Votre commande du " . $this->commande->created_at->format('d/m/Y') . " a été rejetée.")
            ->line("Motif du rejet :")
            ->line($this->raison)
            ->line('Merci de votre compréhension.');
    }
}
