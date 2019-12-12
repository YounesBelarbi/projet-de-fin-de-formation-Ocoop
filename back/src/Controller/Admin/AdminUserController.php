<?php

namespace App\Controller\Admin;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;






/**
 * @Route("/admin/user", name="admin_user_")
 */
class AdminUserController extends AbstractController
{


    /**
     * @Route("/list", name="list", methods={"GET"})
     */
    public function list(UserRepository $guildRepository): Response
    {

        $users = $guildRepository->findAll();

        $response = new Response;
        $arrayUser = [];

        foreach ($users as  $user) {
                $arrayUser [] = [
                    'username' => $user->getUsername(),
                    'description' => $user->getDescription(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'birth' => $user->getBirth(),
                    'email' => $user->getEmail(),
                    'city' => $user->getCity(),
                    'longitude' => $user->getLongitude(),
                    'latitude' => $user->getLatitude(),
                    'mobile' => $user->getMobile(),
                    'avatar' => $user->getAvatar(),

                ];
            }

            $response->setContent(json_encode(
                $arrayUser
            ));        
            $response->headers->set('Content-Type', 'application/json');
            
            ;
            return $response;

       

    }

    /**
     * @Route("/{id}", name="showById", methods={"GET"})
     */
    public function showById(UserRepository $userRepository, $id): Response
    {
    
        $user = $userRepository->find($id);
        $response = new Response;
        $arrayUser = [];
        
        
                $arrayUser [] = [
                    'username' => $user->getUsername(),
                    'description' => $user->getDescription(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'birth' => $user->getBirth(),
                    'email' => $user->getEmail(),
                    'city' => $user->getCity(),
                    'longitude' => $user->getLongitude(),
                    'latitude' => $user->getLatitude(),
                    'mobile' => $user->getMobile(),
                    'avatar' => $user->getAvatar(),
                ];
            
            $response->setContent(json_encode(
                $arrayUser
            ));        
            $response->headers->set('Content-Type', 'application/json');
            
            ;
            return $response;
    }

 

    /**
     * @Route("/edit/{id}", name="edit", methods={"POST"})
     */
    public function edit(Request $request, User $user, EntityManagerInterface $em): Response
    {
        $username=$request->request->get('username');
        $description=$request->request->get('description');
        $firstname=$request->request->get('firstname');
        $lastname=$request->request->get('lastname');
        $birth=$request->request->get('birth');
        $email=$request->request->get('email');
        $city=$request->request->get('city');
        $longitude=$request->request->get('longitude');
        $latitude=$request->request->get('latitude');
        $mobile=$request->request->get('mobile');
        $avatar=$request->request->get('avatar');


        $arrayData = json_decode($request->getContent(), true);

        $birth  = \DateTime::createFromFormat('Y-m-d H:i:s', $arrayData['birth'].' 00:00:00');
        $user->setBirth($birth);

        

        $update = New DateTime();
        
        $user->setUsername($username);
        $user->setDescription($description);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setBirth($birth);
        $user->setEmail($email);
        $user->setCity($city);
        $user->setLongitude($longitude);
        $user->setLatitude($latitude);
        $user->setMobile($mobile);
        $user->setUpdatedAt($update);
        $user->setAvatar($avatar);
        $em->flush(); 
        
        $response = new Response(
            Response::HTTP_OK
        );
        return $response;
    }


    /**
    * @Route("/delete/{id}",name="delete", methods={"POST"})
    */
    public function delete(User $user, EntityManagerInterface $em)
    {
        $em->remove($user);
        $em->flush();
        $response = new Response(
            Response::HTTP_OK
        );
        return $response;
    }
}
