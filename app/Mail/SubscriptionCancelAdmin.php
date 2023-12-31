<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionCancelAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;
    public $frequency;
    public $cancelDate;
    public $qualityLevel;
    public $radioReason;
    public $reasonText;
    public $recommendation;
    public $enableEnd;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer,$frequency,$cancelDate,$qualityLevel, $radioReason,$reasonText,$recommendation,$enableEnd)
    {
        $this->customer = $customer;
        $this->frequency = $frequency;
        $this->cancelDate = $cancelDate;
        $this->qualityLevel = $qualityLevel;
        $this->radioReason = $radioReason;
        $this->reasonText = $reasonText;
        $this->recommendation = $recommendation;
        $this->enableEnd = $enableEnd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->customer->first_name."cancelled plan Fitness ".$this->frequency." on ".$this->cancelDate;
        return $this->subject($subject)->view('emails.subscriptions.cancel_admin');
    }
}