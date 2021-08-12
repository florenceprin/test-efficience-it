<?php

namespace App\Controller;

use App\Entity\FicheContact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/contact", name="main")
     */
    public function index(): Response
    {
        $ficheContact = new FicheContact();
        $form = $this->createForm(ContactType::class,$ficheContact);

        if($form->isSubmitted() && $form->isValid()){
            $ficheContact=$form->getData();
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($ficheContact);
            $entityManager->flush($ficheContact);
            $this->addFlash('success', 'Votre message a bien été envoyé au département sélectionné !');

            $this->redirectToRoute("main");
        }

        return $this->render('main/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
