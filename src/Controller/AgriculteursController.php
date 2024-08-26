<?php

namespace App\Controller;

use App\Entity\Agriculteurs;
use App\Repository\AgriculteursRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

class AgriculteursController extends AbstractController
{
    private $repository;

    public function __construct(AgriculteursRepository $repository)
    {
    $this->repository = $repository;
    
    }

    #[Route('/agriculteurs', name: 'get_agri_list', methods: ['GET'])]
    public function getAllAgriculteurs(AgriculteursRepository $repo, SerializerInterface $serializer): JsonResponse
    {
        $agriList = $repo->findAll();
        $jsonAgriList = $serializer->serialize($agriList, 'json');
        return new JsonResponse($jsonAgriList, Response::HTTP_OK, [], true);
        
    }

    #[Route('/agriculteurs/{id}', name:'detailAgriculteur', methods:['GET'])]
    public function getDetailAgriculteur(int $id, SerializerInterface $serializer, AgriculteursRepository $repo): JsonResponse
    {
        $agriculteur = $repo->find($id);
        if($agriculteur)
        {
            $jsonAgriculteur=$serializer->serialize($agriculteur,'json');
            return new JsonResponse($jsonAgriculteur, Response::HTTP_OK,[],true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/agriculteurs/{id}', name: 'deleteAgriculteur', methods:['DELETE'])]
    public function deleteAgriculteur(Agriculteurs $agriculteur, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($agriculteur);
        $em->flush();
        return new JsonResponse(['message'=>'Agriculteur supprimé'], Response::HTTP_OK);
    }

    #[Route('/agriculteurs', name:'creerAgriculteur', methods:['POST'])]
    public function creerAgriculteur(Request $request,SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator)
    {
        $agriculteur = $serializer->deserialize($request->getContent(), Agriculteurs::class, 'json');
        $em->persist($agriculteur);
        $em->flush();

        $jsonAgriculteur = $serializer->serialize($agriculteur, 'json', ['groups'=>'getAgriculteurs']);

        $location = $urlGenerator->generate('detailAgriculteur',['id'=>$agriculteur->getId()], urlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonAgriculteur, Response::HTTP_CREATED, ["Location"=>$location], true);
    }

}
