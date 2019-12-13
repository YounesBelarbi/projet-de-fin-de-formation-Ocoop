<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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
    public function edit(EntityManagerInterface $em, Request $request): Response
    {
        $user = $this->getUser();
        
        $arrayData = json_decode($request->getContent(), true);
        
        $errors = [];
        if (!$errors) {

            $user->setUsername($arrayData['username']);
            // $user->setRoles($arrayData['role']);
            $user->setEmail($arrayData['email']);
            // $user->setPassword($password);
            $user->setBirth(\DateTime::createFromFormat('Y-m-d H:i:s', $arrayData['birth'].' 00:00:00'));
            // $user->setAvatar($arrayData['avatar']);
            $user->setDescription($arrayData['description']);
            $user->setFirstname($arrayData['firstname']);
            $user->setLastname($arrayData['lastname']);
            $user->setcity($arrayData['city']);
            $user->setMobile($arrayData['mobile']);
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());

            try
            {
                $entityManager = $this->getDoctrine()->getManager();
                // $entityManager->persist($user);
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
