<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $job;
    public $title;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company, $job, $title, $name)
    {
        $this->company = $company;
        $this->job = $job;
        $this->title = $title;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->details);
        return $this->subject('Wellcome to Soucted')
                    ->view('emails.refferarl');
    }
}
