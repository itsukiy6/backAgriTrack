<?php

namespace App\Controller;

use App\Entity\Agriculteurs;
use App\Repository\AgriculteursRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\AgriculteurPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AgriculteursController extends AbstractController
{
    private $repository;
    private UserPasswordHasherInterface $hasher;
    public function __construct(AgriculteursRepository $repository, UserPasswordHasherInterface $hasher)
    {
    $this->repository = $repository;

    $this->hasher = $hasher;
    
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
        $hashPassword = $this->hasher->hashPassword($agriculteur,'password');
        $agriculteur->setPassword($hashPassword);
        $em->persist($agriculteur);
        $em->flush();


        $context = SerializationContext::create()->setGroups(['getAgriculteurs']);
        $context = $request->toArray(); 
        $jsonAgriculteur = $serializer->serialize($agriculteur ,'json', $context);
        return new JsonResponse($jsonAgriculteur, Response::HTTP_ACCEPTED,[], true); // Reponse json
    }


    #[Route('/agriculteurs/{id}', name:'modifAgriculteur', methods:['PUT'])]
    public function modifierAgriculteur(int $id, AgriculteursRepository $repo, EntityManagerInterface $em, Agriculteurs $currentAgriculteur, Request $request, SerializerInterface $serializer, ValidatorInterface $validator ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $newAgriculteur = $serializer->deserialize($request->getContent(), Agriculteurs::class,'json');
        $currentAgriculteur->setEmail($newAgriculteur->getEmail()); // Définit la nouvel adresse e-mail

       $currentAgriculteur->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
        $currentAgriculteur->setTel($newAgriculteur->getTel()); // Définit le nouveau numéro de téléphone
        $errors = $validator->validate($currentAgriculteur); // Initialise l'erreur
        if (count($errors) > 0)  // Boucle si l'Agriculteur n'existe pas dans la base de données
        {   
            return new JsonResponse($serializer->serialize($errors, 'json'), Response::HTTP_BAD_REQUEST, [], true);
        } 
        $content = $request->toArray();  // Transformer la requête en tableau
        
        $em->persist($currentAgriculteur); // persister 
        $em->flush(); // enregistrer les modif
        
        $context = SerializationContext::create()->setGroups(['getAgriculteurs']);
        $context = $request->toArray(); 
        $jsonAgriculteur = $serializer->serialize($newAgriculteur ,'json', $context);
        return new JsonResponse($jsonAgriculteur, Response::HTTP_OK,[], true); // Reponse json
        // $context = SerializationContext::create()->setGroups(['getAgriculteurs']);
        // $context = $request->toArray(); 
        // $jsonNewAgriculteur = $serializer->serialize($newAgriculteur ,'json', $context);
        // return new JsonResponse($jsonNewAgriculteur, Response::HTTP_ACCEPTED,[], true); // Reponse json
    }

}