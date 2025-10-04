<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class ScraperCompleted extends Notification
{
    use Queueable;

    private $username;
    private $status;
    private $processType;

    /**
     * Create a new notification instance.
     */
    public function __construct($username, $status = 'Completed', $processType = 'Character Data Scraping')
    {
        $this->username = $username;
        $this->status = $status;
        $this->processType = $processType;
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
        Log::info("Mengirim email ke: " . $notifiable->email);
        
        $actionUrl = url('/dashboard/data_scraper?tab=characters');
        
        $data = [
            'username' => $this->username,
            'status' => $this->status,
            'actionUrl' => $actionUrl,
            'subject' => 'Data Scraping Process ' . $this->status,
            'processType' => $this->processType
        ];
        
        return (new MailMessage)
            ->subject('Data Scraping Process ' . $this->status)
            ->view('emails.scraper-notification', $data);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable)
    {
        return [
            //
        ];
    }
}
