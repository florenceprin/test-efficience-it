<?php

namespace App\Controller;

use App\Entity\Departements;
use App\Entity\FicheContact;
use App\Service\ContactMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/departments ", name="departments")
     */
    public function departments(SerializerInterface $serializer): Response
    {

        $em = $this->getDoctrine()->getManager();
        $error = false;
        $status = 200;
        $errorMessage = "";
        try {
            $departments = $em->getRepository(Departements::class)->findAll();
        } catch (\Exception $e) {
            $error = true;
            $departments = [];
            $status = 500;
            $errorMessage = $e->getMessage();
        }
        $response = ["data" => $departments,
            "error" => $error];
        if ($errorMessage !== "") {
            $response["error_message"] = $errorMessage;
        }
        $departments = $serializer->serialize($response, 'json');


        return new JsonResponse($departments, $status);

    }

    /**
     * @Route("/contact ", name="contact", methods={"POST"})
     */
    public function contact(ContactMailer $mailer, Request $request, SerializerInterface $serializer)
    {

        $error = false;
        $status = 200;
        $errorMessage = "";


        try {
            $json = $request->getContent();
            $ficheContact = $serializer->deserialize($json, FicheContact::class, 'json');
            $data = json_decode($json, true);
            $entityManager = $this->getDoctrine()->getManager();
            $department = $entityManager->getRepository(Departements::class)->find($data["department"]);
            $ficheContact->setDepartment($department);
            $entityManager->persist($ficheContact);
            $entityManager->flush($ficheContact);
            $ficheContact = $entityManager->getRepository(FicheContact::class)->find($ficheContact->getId());
        } catch (\Exception $e) {
            $error = true;
            $errorMessage = $e->getMessage();
        }

        if (!$error) {
            $error = !$mailer->sendMail($ficheContact);
        }

        if ($error) {
            $status = 500;
            $ficheContact = [];
        }

        $response = ["data" => $ficheContact,
            "error" => $error,
        ];
        if ($errorMessage !== "") {
            $response["error_message"] = $errorMessage;
        }
        $response = $serializer->serialize($response, 'json');


        return new JsonResponse($response, $status);
    }
}
