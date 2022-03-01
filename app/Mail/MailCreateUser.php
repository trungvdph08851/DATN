<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCreateUser extends Mailable
{
    use Queueable, SerializesModels;
//    #MAIL_HOST=smtp.gmail.com
//#MAIL_PORT=587
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Xác nhận tài khoản')->view('backend.mails.sendMailConfirmUser');
    }
}
