<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class SecurityAuthenticator extends AbstractGuardAuthenticator
{ 
    
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
       $this->passwordEncoder = $passwordEncoder;
    }


    public function supports(Request $request)
    {
        return $request->get("_route") === "api_login" && $request->isMethod("POST");
    }


    public function getCredentials(Request $request)
    { 
        $arrayData = json_decode($request->getContent(), true);
        dump($arrayData);
        
        // a modifier en fonction des données envoyées sur le formulaire de login 
        return $arrayData;    
    }
    

    public function getUser($credentials, UserProviderInterface $userProvider)
    {   
        // dump($credentials);
        // dump($credentials['email']);
        // die;
        // dump($userProvider->loadUserByUsername($credentials['email']));
        // die;
        return $userProvider->loadUserByUsername($credentials['email']); 
        //return $this->userRepository->findOneBy(['email' => $credentials['email']]);  
    }
        

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }


    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            'error' => $exception->getMessageKey()
        ], 400);
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }


    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            'error' => 'Access Denied'
        ]);    
    }

    
    public function supportsRememberMe()
    {
        return false;
    }
}
