<?php

namespace App\Controller;

use App\Entity\Guild;
use App\Form\Guild1Type;
use App\Repository\GuildRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
;



/**
 * @Route("/guild")
 */
class GuildController extends AbstractController
{


    /**
     * @Route("/show", name="guild_index", methods={"GET"})
     */
    public function show(GuildRepository $guildRepository): Response
    {

        $guilds = $guildRepository->findAll();

        $response = new Response;
        $arrayGuild = [];

        foreach ($guilds as  $guild) {
                $arrayGuild [] = [
                    'title' => $guild->getname(),
                    'description' => $guild->getDescription(),

                ];
            }

            $response->setContent(json_encode(
                $arrayGuild
            ));        
            $response->headers->set('Content-Type', 'application/json');
            
            ;
            return $response;

       

    }

    /**
     * @Route("/new", name="guild_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {

        $arrayData = json_decode($request->getContent(), true);

        $guild = new Guild;
        $guild->setName($arrayData['name']);
        $guild->setDescription($arrayData['description']);
       

        $em->persist($guild);
        $em->flush();


        return $this->json([
            'good' => $arrayData
        ]);
    }

   

    /**
     * @Route("/edit/{id}", name="guild_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Guild $guild, EntityManagerInterface $em): Response
    {
        $name=$request->request->get('name');
        $guild->setName($name);

        $em->flush(); 
        
        $response = new Response(
            $guild,
            Response::HTTP_OK,
            ['content-type' => 'json']
        );
        return $response;
    }


    /**
    * @Route("/delete/{id}")
    */
    public function delete(Guild $guild, EntityManagerInterface $em)
    {
        $em->remove($guild);
        $em->flush();
        $response = new Response(
            Response::HTTP_OK
        );
        return $response;
    }
}
