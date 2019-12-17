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
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AuthenticatorInterface;


/**
 * @Route("api/user", name="api_user_")
 */
class MatchmakingController extends AbstractController
{
    /**
     * @route("/matchmaking", name="matchmaking", methods={"POST"})
     */
    public function matchmaking(UserInterface $user, Request $request, RankRepository $rankRepository, GameRepository $gameRepository, FavoriteGameRepository $favoriteGameRepository)
    {
        //get data from request in json
        $matchmakingData = json_decode($request->getContent(), true);
        
        //Get game_id and rank_id from the request
        $userGameId = $matchmakingData['game_id'];
        $userRankId = $matchmakingData['rank_id'];

        $allRankByGame = $rankRepository->findRanksByGame($userGameId);

        for($i = 0; $i <= 3; $i++) {
            foreach($allRankByGame as $rank) {
                if($userRankId-$i === $rank->getId()){
                    $minInterval = $rank->getId();
                }
                if($userRankId+$i === $rank->getId()){
                    $maxInterval = $rank->getId();
                }
            }
        }

        $usersMatch = $favoriteGameRepository->findByGameAndRank($userGameId, $minInterval, $maxInterval);
        
        $usersMatchList = [];
        foreach($usersMatch as $userMatch) {
            if($user->getId() !== $userMatch->getUser()->getId()) {
                $userList[]= [
                    'user_id' => $userMatch->getUser()->getId(),
                    'username' => $userMatch->getUser()->getUsername(),
                    'description' => $userMatch->getUser()->getDescription(),
                    'rank_name' => $userMatch->getRank()->getName(),
                    'rank_id' => $userMatch->getRank()->getId(),
                    'rank_logo' => $userMatch->getRank()->getLogo()
                ];
            }
        }

        return $this->json(['user_match' => $userList]);
    }
}