<?php

namespace App\Service;

use App\Entity\FicheContact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactMailer
{

    private $mailer;

    public function __construct(MailerInterface $mailer){
        $this->mailer=$mailer;
    }

    public function sendMail(FicheContact $ficheContact)
    {
        $destinataire = $ficheContact->getDepartement()->getEmail();
        $expediteur = $ficheContact->getEmail();

        $email = (new Email())
            ->from($expediteur)
            ->to($destinataire)
            ->subject('Mail from contact page')
            ->text($ficheContact->getMessage());;

        try {
            $this->mailer->send($email);
            return true;
        } catch (\Exception $e) {
            return false;
        }


    }
}