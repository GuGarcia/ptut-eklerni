<?php

namespace Eklerni\CASBundle\Form\Handler;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface{

    protected $router;
    protected $security;

    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    /**
     * @inheritdoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($this->security->isGranted('ROLE_DIRECTEUR') || $this->security->isGranted('ROLE_ENSEIGNANT')) {
            $response = new RedirectResponse($this->router->generate('eklerni_back_homepage'));
        } elseif ($this->security->isGranted('ROLE_ELEVE')) {
            $response = new RedirectResponse($this->router->generate('eklerni_front_homepage'));
        }

        return $response;
    }
}