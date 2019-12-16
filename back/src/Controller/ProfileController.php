<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FrequencyRepository;
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
    public function edit(EntityManagerInterface $em, Request $request, FrequencyRepository $frequencyRepository): Response
    {
        $user = $this->getUser();
        
        $arrayData = json_decode($request->getContent(), true);

        $frequency = $frequencyRepository->find(['id' => $arrayData['frequency_id']]);

        $errors = [];
        if (!$errors) {
            $user->setUsername($arrayData['username']);
            $user->setEmail($arrayData['email']);
            $user->setBirth(\DateTime::createFromFormat('Y-m-d H:i:s', $arrayData['birth'].' 00:00:00'));
            $user->setDescription($arrayData['description']);
            $user->setFrequency($frequency);
            $user->setFirstname($arrayData['firstname']);
            $user->setLastname($arrayData['lastname']);
            $user->setcity($arrayData['city']);
            $user->setMobile($arrayData['mobile']);
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
