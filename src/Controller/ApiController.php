<?php

namespace App\Controller;

use App\Entity\Departements;
use App\Entity\FicheContact;
use App\Form\ContactType;
use App\Service\ContactMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class ApiController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/departments ", name="departments")
     */
    public function departments(SerializerInterface $serializer): Response
    {

        $response = [
            "data" => [],
            "error" => false];
        try {
            $departments = $this->em->getRepository(Departements::class)->findAll();
            $response ["data"] = $serializer->normalize($departments);
            $status = 200;
        } catch (\Exception|ExceptionInterface $e) {
            $response["error"] = true;
            $response["error_message"] = $e->getMessage();
            $status = 500;
        }

        return new JsonResponse($response, $status);

    }

    /**
     * @Route("/contact ", name="contact", methods={"POST"})
     */
    public function contact(ContactMailer $mailer, Request $request, SerializerInterface $serializer)
    {
        $data = json_decode($request->getContent(), true);
        $ficheContact = new FicheContact();
        $form = $this->createForm(ContactType::class, $ficheContact);
        $em = $this->getDoctrine()->getManager();

        try {
            $form->submit($data);
            $this->em->persist($ficheContact);
            $this->em->flush();
            if ($mailer->sendMail($ficheContact) == false) {
                throw (new \Exception);
            }
            $status = 201;
            $message = 'Le formulaire de contact a bien été transmis par mail au département choisi.';
        } catch (\Exception $e) {
            $status = 400;
            $message = $e->getMessage();
        }

        $body = [
            "data" => $data,
            "message" => $message];

        return new JsonResponse($message, $status);
    }


}
