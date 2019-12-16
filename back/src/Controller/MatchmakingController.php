<?php

namespace App\Controller;

use App\Entity\FavoriteGame;
use App\Entity\User;
use App\Repository\FavoriteGameRepository;
use App\Repository\GameRepository;
use App\Repository\RankRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("api/user", name="api_user_")
 */
class MatchmakingController extends AbstractController
{
    /**
     * @route("/matchmaking", name="matchmaking", methods={"POST"})
     */
    public function matchmaking(Request $request, RankRepository $rankRepository, GameRepository $gameRepository, FavoriteGameRepository $favoriteGameRepository)
    {
        //get data from request in json
        $matchmakingData = json_decode($request->getContent(), true);
        

        $game = $gameRepository->find(['id' => $matchmakingData['game_id']]);
        
        $rank = $rankRepository->find(['id' => $matchmakingData['rank_id']]);
       

        $userMatch = $favoriteGameRepository->findByGameAndRank($game, $rank);
     

        $userList = [];
        for ($i= 0 ; $i < count($userMatch); $i++) { 
            
            $userList[]= [
                
                'user_id' => $userMatch[$i]->getUser()->getId(),
                'description' => $userMatch[$i]->getUser()->getDescription(),
                'username' => $userMatch[$i]->getUser()->getUsername(),
                'avatar' => $userMatch[$i]->getUser()->getAvatar(),
                'city' => $userMatch[$i]->getUser()->getCity(),
                'frequency' => $userMatch[$i]->getUser()->getFrequency(),
                'rank' => $userMatch[$i]->getRank()->getName()
            ];
        }

        return $this->json(['user_match' => $userList]);
    }
}
