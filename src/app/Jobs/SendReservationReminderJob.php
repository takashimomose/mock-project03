<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ReservationReminderMail;
use Illuminate\Support\Facades\Mail;

class SendReservationReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation->toArray();
    }

    public function handle()
    {
        Mail::to($this->reservation['user_email'])->send(new ReservationReminderMail($this->reservation));
    }
}
