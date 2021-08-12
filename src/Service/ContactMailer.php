<?php

namespace App\Service;

use App\Entity\FicheContact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactMailer
{

    public function sendMail(FicheContact $ficheContact, MailerInterface $mailer)
    {
        $destinataire = $ficheContact->getDepartement()->getEmail();
        $expediteur = $ficheContact->getEmail();

        $email = (new Email())
            ->from($expediteur)
            ->to($destinataire)
            ->subject('Mail from contact oage')
            ->text($ficheContact->getMessage());;

        try {
            $mailer->send($email);
            return true;
        } catch (\Exception $e) {
            return false;
        }


    }
}