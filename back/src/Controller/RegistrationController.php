<?php

namespace App\Controller;

use App\Entity\Frequency;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
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



        //create new user and get informtions from request json
        $user = new User();

        $username               = $request->request->get('username');
        $description            = $request->request->get('description');
        $firstname              = $request->request->get('firstname');
        $lastname               = $request->request->get('lastname');
        $birth                  = \DateTime::createFromFormat('Y-m-d H:i:s', $request->request->get('birth').' 00:00:00');
        $city                   = $request->request->get('city');
        $mobile                 = $request->request->get('mobile');
        $avatar                 = $request->request->get('avatar');
        $email                  = $request->request->get("email");
        $password               = $request->request->get("password");
        $passwordConfirmation   = $request->request->get("password_confirmation");
       
        
        
        // test password
        $errors = [];
        if ($password != $passwordConfirmation) {
            $errors[] = "Les mots de passe doivent être identique.";
        }
        
        if (strlen($password) < 6) {
           $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
           $errors["password"] = $password; // juste pour tester ;)
           $errors["request"] = $request; // juste pour tester ;)
        }
        
  
        // if we have no error we register the user
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
            
           

            // test for fields that must be unique
            try
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->json([
                    'user' => $user
                ]);
              
            }
            catch(UniqueConstraintViolationException $e)
            {
                $errors[] = "mail ou username déjà utilisés";
                
            }
            catch(\Exception $e)
            {
                
                $errors[] = "Ce mail est déjà pris, désolé!";
            }

        }


        // in case of an error we return 400
        return $this->json([
            'errors' => $errors
        ], 400);


    }
}
