<?php

namespace App\Controller;

use App\Entity\Departements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $status=200;
        try {
            $departments = $em->getRepository(Departements::class)->findAll();
        } catch (\Exception $e) {
            $error = true;
            $departments = [];
            $status=500;
        }
        $response = ["data" => $departments,
            "error" => $error];
        $departments = $serializer->serialize($response, 'json');


        return new JsonResponse($departments,$status);

    }

    /**
     * @Route("/contact ", name="contact")
     */
    public function contact()
    {
    }
}
