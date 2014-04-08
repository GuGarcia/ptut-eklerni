<?php

namespace Eklerni\CASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SignController extends Controller
{

    public function loginAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        $csrfToken = $this->container->has('form.csrf_provider') ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate') : null;
        
        return $this->render('EklerniCASBundle:Sign:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
            'csrf_token' => $csrfToken,
            'title' => "Login"
        ));
    }

    public function loginCheckAction()
    {
        // The security layer will intercept this request
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction(Request $request)
    {
        // The security layer will intercept this request
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
} 