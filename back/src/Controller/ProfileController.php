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
     * @Route("/", name="show")
     */
    public function show()
    {
        $user = $this->getUser();
        
        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]); 
    }

    /**
     * @Route("/edit", name="edit", methods={"POST"})
     */
    public function edit(EntityManagerInterface $em, Request $request): Response
    {
        $user = $this->getUser();
        
        // $user = new User();

        // $password = $user->getPassword();
        
        $arrayData = json_decode($request->getContent(), true);

        $username               = $arrayData['username'];
        // $role               = $arrayData['role'];
        $email                  = $arrayData['email'];          
        $birth                  = \DateTime::createFromFormat('Y-m-d H:i:s', $arrayData['birth'].' 00:00:00');
        $description            = $arrayData['description'];
        // $avatar                 = $arrayData['avatar'];
        $firstname              = $arrayData['firstname'];
        $lastname               = $arrayData['lastname'];
        $city                   = $arrayData['city'];
        $mobile                 = $arrayData['mobile'];
        
        $errors = [];
        if (!$errors) {

            $user->setUsername($username);
            // $user->setRoles($role);
            $user->setEmail($email);
            // $user->setPassword($password);
            $user->setBirth($birth);
            // $user->setAvatar($avatar);
            $user->setDescription($description);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setcity($city);
            $user->setMobile($mobile);
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($user);
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
