<?php

namespace App\Events\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\EventDispatcher\EventDispatcher;

class AuthenticationFailureListener extends EventDispatcher
{
    /**
     * @param AuthenticationFailureEvent $event
     * 
     * @return void
     */
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {
        $data = "L'email ou le mot de passe est incorrect";

        $response = new JWTAuthenticationFailureResponse($data);

        $event->setResponse($response);
    }
}
