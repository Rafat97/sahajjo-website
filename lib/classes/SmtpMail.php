<?php

namespace Lib\Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class SmtpMail extends PHPMailer
{
  
    private $host_name = "";
    private $user_name = "";
    private $password = "";   
    private $port_number = "";   
    private $from_mail = "";   
    private $mail;                                            

    function __construct($host,$name,$pass,$port,$setmail)
    {
        $this->host_name = $host;
        $this->user_name = $name;
        $this->password = $pass;
        $this->port_number = $port;
        $this->from_mail = $setmail;

        $this->mail = new PHPMailer(true);
        //$this->mail->isSMTP();  
        try {
            //Server settings
            $this->mail = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $this->mail->isSMTP();                                 // Send using SMTP
            $this->mail->Host       = 'smtp.mailgun.org';                    // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = 'postmaster@sandboxd3381ef9db1b44b49660f116c3b8f8bc.mailgun.org';                     // SMTP username
            $this->mail->Password   = 'ed4207d018484917b2df5213ac419b19-1b65790d-acedc95b';                               // SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $this->mail->Port       = 587;                                    // TCP port to connect to


            $this->mail->setFrom($this->from_mail, $this->user_name);
            $this->mail->isHTML(true);   
        }catch (Exception $e) {
            echo "Error: {$this->mail->ErrorInfo}";
        }
    }
    function addMail($Email,$name)
    {
        try {
           
            $this->mail->addAddress($Email, $name);     // Add a recipient
        }catch (Exception $e) {
            echo "Error: {$this->mail->ErrorInfo}";
        }
    }
    function addSubject($subject)
    {
        try {
            $this->mail->Subject($subject); 
        }catch (Exception $e) {
            echo "Error: {$this->mail->ErrorInfo}";
        }
    }
    function addBody($body)
    {
        try {
            $this->mail->Body = $body;
        }catch (Exception $e) {
            echo "Error: {$this->mail->ErrorInfo}";
        }
    }
    function sendMail()
    {
        try {
            $this->mail->send();
        }catch (Exception $e) {
            echo "Error: {$this->mail->ErrorInfo}";
        }
    }
}
