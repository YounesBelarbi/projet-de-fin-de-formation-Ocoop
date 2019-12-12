<?php
namespace App\Controller\Admin;
use App\Entity\Guild;
use App\Repository\GuildRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
;
/**
 * @Route("/admin/guild", name="admin_guild_")
 */
class AdminGuildController extends AbstractController
{
    /**
     * @Route("/list", name="list", methods={"GET"})
     */
    public function list(GuildRepository $guildRepository): Response
    {
        $guilds = $guildRepository->findAll();
        $response = new Response;
        $arrayGuild = [];
        foreach ($guilds as  $guild) {
                $arrayGuild [] = [
                    'title' => $guild->getname(),
                    'description' => $guild->getDescription(),
                    'avatar' => $guild->getAvatar(),
                    'banner' => $guild->getBanner(),
                   
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
     * @Route("/{id}", name="showById", methods={"GET"})
     */
    public function showById(GuildRepository $guildRepository, $id): Response
    {
    
        $guild = $guildRepository->find($id);
        $response = new Response;
        $arrayGuild = [];
        
        
                $arrayGuild [] = [
                    'name' => $guild->getName(),
                    'description' => $guild->getDescription(),
                    'avatar' => $guild->getAvatar(), 
                    'banner' => $guild->getBanner(),
                ];
            
            $response->setContent(json_encode(
                $arrayGuild
            ));        
            $response->headers->set('Content-Type', 'application/json');
            
            ;
            return $response;
    }
    /**
     * @Route("/new", name="new", methods={"POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $arrayData = json_decode($request->getContent(), true);
        $guild = new Guild;
        $guild->setName($arrayData['name']);
        $guild->setDescription($arrayData['description']);
        $guild->setDescription($arrayData['avatar']);
        $guild->setDescription($arrayData['banner']);
       
        $em->persist($guild);
        $em->flush();
        return $this->json([
            'good' => $arrayData
        ]);
    }
   
    /**
     * @Route("/edit/{id}", name="edit", methods={"POST"})
     */
    public function edit(Request $request, Guild $guild, EntityManagerInterface $em): Response
    {
        $name=$request->request->get('name');
        $description=$request->request->get('description');
        $avatar=$request->request->get('avatar');
        $banner=$request->request->get('banner');
        $update = New DateTime();
        $guild->setName($name);
        $guild->setDescription($description);
        $guild->setAvatar($avatar);
        $guild->setBanner($banner);
        $guild->setUpdatedAt($update);
        $em->flush(); 
        
        $response = new Response(
            $guild,
            Response::HTTP_OK,
            ['content-type' => 'json']
        );
        return $response;
    }
    /**
    * @Route("/delete/{id}", name="delete", methods={"POST"})
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