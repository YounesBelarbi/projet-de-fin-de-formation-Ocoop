<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\File\File;

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

    /**
     * @route("/edit/avatar", name="edit_avatar")
     */
    public function editAvatar(EntityManagerInterface $em, Request $request): Response
    {
        $arrayData = json_decode($request->getContent(), true);

        $user = new User();
 
        $avatar = $arrayData['avatar'];        
         
        $user->setAvatar($avatar);

        $errors = [];
        if (!$errors) {
        $uploadedFile = $arrayData['avatar']->getData();
            
        $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFileName);
        $newFileName = $safeFileName.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $destination = $this->getParameter('kernel.project_dir').'/public/uploads/avatars';

        $uploadedFile->move($destination, $newFileName);
            
        $uploadedFile = $user->getAvatar();

        $entityManager = $this->getDoctrine()->getManager();
        $user->setAvatar($newFileName);
        $entityManager->persist($user);
        $entityManager->flush();
 
            return $this->json([
                'success' => 'success'
            ]);  
        }

        return $this->json([
            $errors
        ], 400);
    }

     /**
     * @Route("/delete/avatar", name="delete_avatar")
     */
    public function deleteAvatar(EntityManagerInterface $em)
    {
        $user = $this->getUser();
        
        $newFileName = 'default-avatar.png';
        
        $em = $this->getDoctrine()->getManager();
        $user->setAvatar($newFileName);
        $em->persist($user);
        $em->flush();

        return $this->json([
                'success' => 'success'
            ]);  
    }
}
