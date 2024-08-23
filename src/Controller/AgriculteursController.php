<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class AgriculteursController extends AbstractController
{
    #[Route('/agriculteurs', name: 'agriculteurs')]
    public function index(): JsonResponse
    {


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AgriculteursController.php',
        ]);
    }




}
