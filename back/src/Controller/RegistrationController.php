<?php

namespace App\Controller;

use App\Entity\Frequency;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{


    /**
     * @Route("api/register", name="api_register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {


        // create new user and get informtions from request json
        $user = new User();

        $username               = $request->request->get('username');
        $description            = $request->request->get('description');
        $firstname              = $request->request->get('firstname');
        $lastname               = $request->request->get('lastname');
        $birth                  = $request->request->get('birth');
        $city                   = $request->request->get('city');
        $mobile                 = $request->request->get('mobile');
        $avatar                 = $request->request->get('avatar');
        $email                  = $request->request->get("email");
        $password               = $request->request->get("password");
        $passwordConfirmation   = $request->request->get("password_confirmation");
        $frequency              = $request->request->get("frequency");


        
        // test password
        $errors = [];
        if ($password != $passwordConfirmation) {
            $errors[] = "Password does not match the password confirmation.";
        }
        
        if (strlen($password) < 6) {
           $errors[] = "Password should be at least 6 characters.";
        }
        
  
        //if we have no error we register the user
        if (!$errors) {
            
            $encodedPassword = $passwordEncoder->encodePassword($user, $password);
            $user->setEmail($email);
            $user->setPassword($encodedPassword);
            $user->setUsername($username);
            $user->setDescription($description);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setBirth($birth);
            $user->setCity($city);
            $user->setMobile($mobile);
            $user->setAvatar($avatar);
            $user->setCreatedAt(new \DateTime());
            
            
            // $userFrequency = new Frequency;
            // $userFrequency->setName($frequency);
            // $user->setFrequency($userFrequency);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json([
                'user' => $user
            ]);
        }


        // in case of an error we return 400
        return $this->json([
            'errors' => $errors
        ], 400);

        



    }
}
