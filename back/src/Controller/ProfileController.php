<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FrequencyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @route("api/profile", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/edit", name="edit", methods={"POST"})
     */
    public function edit(EntityManagerInterface $em, Request $request, FrequencyRepository $frequencyRepository): Response
    {
        $user = $this->getUser();
        
        $arrayData = json_decode($request->getContent(), true);

        //Une condition pour éviter le fais d'aller chercher une chaine de caractere vide en name ;-)
        if($arrayData['frequency'] !== ""){
            //findOneBy car findBy te renvois un tableau d'objet, ce que tu set dans user c'est l'objet directement
            $frequency = $frequencyRepository->findOneBy(['name' => $arrayData['frequency']]);
            $user->setFrequency($frequency);
        }

        $errors = [];
        if (!$errors) {
            //Pour l'instant on gére pas encore les autres champs via la card de l'utilisateur
            $user->setUsername($arrayData['username']);
            //$user->setEmail($arrayData['email']);
            //$user->setBirth(\DateTime::createFromFormat('Y-m-d H:i:s', $arrayData['birth'].' 00:00:00'));
            $user->setDescription($arrayData['description']);

            // $user->setFirstname($arrayData['firstname']);
            //$user->setLastname($arrayData['lastname']);
            //$user->setcity($arrayData['city']);
            //$user->setMobile($arrayData['mobile']);

            $user->setUpdatedAt(new \DateTime());

            try
            {
                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->flush();
              
                return $this->json([
                    'success' => 'success'
                    ]);  
            }

            catch(UniqueConstraintViolationException $e)
            {
                $errors = ['Erreur'];
            }
          
        }
        return $this->json([
            $errors
        ], 400);
    }
}
