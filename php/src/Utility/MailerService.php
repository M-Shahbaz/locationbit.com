<?php

namespace App\Utility;

use PHPMailer\PHPMailer\Exception as PHPMailerException;

class MailerService
{
    protected $senderEmail;
    protected $senderName;
    protected $replyToEmail;
    protected $replyToName;
    public $mail;

    public function __construct($senderName = null,
                                $replyToEmail = null,
                                $replyToName= null, 
                                $show_embeded_images = true, 
                                $embededImages = [[IMAGE_FOLDER.'logo_emails_internal.png', 'img-logo','logo.png'],
                                                  [IMAGE_FOLDER.'email_colour_stripe.png','img-colour_stripe','colour_stripe.png']
                                                 ]
                                )
    {
        $this->senderEmail = getenv('SMTP_SENDER_EMAIL');
        $this->senderName= $senderName ?: APP_NAME;
        $this->replyToEmail = $replyToEmail ?: getenv('COMPANY_EMAIL_INFO');
        $this->replyToName = $replyToName ?: getenv('COMPANY_NAME');

        $this->mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        $this->mail->IsSMTP();
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SetLanguage("de");
        $this->mail->SMTPAuth = true;
        //$mail->SMTPDebug = 3;

        $this->mail->SMTPSecure = "tls";
        $this->mail->Host = getenv('SMTP_HOST');
        $this->mail->Port = getenv('SMTP_PORT');
        $this->mail->Username = getenv('SMTP_USER');
        $this->mail->Password = getenv('SMTP_PASS');

        //images
        if($show_embeded_images){
            foreach($embededImages as $img){
                $this->mail->AddEmbeddedImage($img[0],$img[1],$img[2]);
            }
        }


    }
    public function send($subject, array $receiver, $body){

        //Send email
        $result = null;

        try{

            $this->mail->setFrom($this->senderEmail, $this->senderName);
            $this->mail->addReplyTo($this->replyToEmail, $this->replyToName);
            $this->mail->AddAddress($receiver['email'], $receiver['name']);
            $this->mail->Subject = $subject;
            $this->mail->isHTML(true);
            $this->mail->MsgHTML($body);

            if($this->mail->Send())
                $result =  true;
        }
        catch (PHPMailerException $e) {
            var_dump($e);
            $result = array('status'=>false, 'error'=>$e->errorMessage());
        }
        catch (\Throwable $e) {
            var_dump($e);
            $result = array('status'=>false, 'ERROR'=>$e->getMessage());
        }
        return $result;
    }

}