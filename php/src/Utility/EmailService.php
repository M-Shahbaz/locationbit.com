<?php

namespace App\Utility;

use App\Domain\Email\Data\EmailSendData;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\PHPMailer;
use Twig\Environment;
use UnexpectedValueException;


final class EmailService
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function send(EmailSendData $emailSendData): ?Bool
    {
        $emailSendData->validate();

        $mail = new PHPMailer(true);
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPSecure = "tls";
        //$mail->SMTPDebug  = 3;

        $mail->IsSMTP();
        $mail->SetLanguage(getenv('APP_DEFAULT_LANGUAGE'));

        $mail->Host = getenv('SMTP_HOST');
        $mail->Port = getenv('SMTP_PORT');
        $mail->Username = getenv('SMTP_USER');
        $mail->Password = getenv('SMTP_PASS');

        $mail->isHTML(true);


        if (!is_null($emailSendData->attachment)) {
            $mail->AddStringAttachment($emailSendData->attachment, $emailSendData->attachmentName);
        }

        foreach ((array)$emailSendData->ccReceiver as $cc) {
            $mail->addCC($cc);
        }

        foreach ((array)$emailSendData->bccReceiver as $bcc) {
            $mail->addBCC($bcc);
        }

        foreach ((array)$emailSendData->receivers as $email) {
            $mail->addAddress($email);
        }

        if (!empty($emailSendData->email)) {
            $mail->addAddress($emailSendData->email, $emailSendData->name ?? "{$emailSendData->fname} {$emailSendData->lname}");
        }

        try {
            $mail->Subject = $emailSendData->emailSubject;
            $mail->setFrom(getenv('COMPANY_EMAIL_INFO'), getenv('COMPANY_NAME'));
            
            $mail->MsgHTML(
                $emailSendData->twigBody ??
                    $this->twig->render('emails/emptyBody.html.twig', [
                        'header_title' => 'BeneFY',
                        'header_subtitle' => 'update erfolgreich',
                        'base_url' => BASE_URL,
                        'company_name' => getenv('COMPANY_NAME'),
                        'primary_color' => APP_COLORS[1],
                        'mailto' => $emailSendData->email,
                        'company_website' => COMPANY_WEBSITE,
                        'content_placeholder' => $emailSendData->emailBody,
                        'notes' => 'Importierte Datensätze',
                    ])
            );
            return $mail->send();
        } catch (PHPMailerException $e) {
            throw new UnexpectedValueException($e->getMessage());
        }
    }
}
