<?php
 
namespace App\Helpers;
 
 
use Illuminate\Contracts\Mail\Mailer;


class MailerFactory 
{
    protected $mailer;
    protected $fromAddress = 'test@test.loc';
    protected $fromName = 'Mini CRM';
 
 
    /**
     * MailerFactory constructor.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
 
        $this->fromAddress = $fromAddress;
    }
 
 
    /**
     * sendCallbackEmail
     *
     *
     * @param $subject
     * @param $user
     */
    public function sendCallbackEmail($mailto, $subject, $data)
    {
        $headers = $this->getHeaders();
        $message = $this->view('emails.callback', compact('data', 'subject'))

        mail($mailto,$subject,$message,$headers);
    }

    public function getHeaders()
    {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
        $headers .= 'From: <'.$fromAddress.'>' . "\r\n";

        return $headers;
    }


}





