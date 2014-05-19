<?php
namespace Eklerni\BackBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ExceptionListener
{
    /**
     * @var EngineInterface
     */
    protected $templating;
    protected $kernel;
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(EngineInterface $templating, $kernel, $container)
    {
        $this->templating = $templating;
        $this->kernel = $kernel;
        $this->container = $container;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ('prod' == $this->kernel->getEnvironment()) {
            // exception object
            $exception = $event->getException();

            // new Response object
            $response = new Response();

            // set response content
            $user = $this->getUser();
            if ($user) {
                if ('ROLE_ELEVE' === $user->getRoles()) {
                    // TODO handle error in front
                } else {
                    $response->setContent(
                        $this->templating->render('EklerniBackBundle:Exception:Exception.html.twig', array('exception' => $exception))
                    );
                }
            }

            // HttpExceptionInterface is a special type of exception that
            // holds status code and header details
            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
                $response->headers->replace($exception->getHeaders());
            } else {
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            // set the new $response object to the $event
            $event->setResponse($response);
        }
    }

    private function getUser()
    {
        if (!$this->container->has('security.context')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.context')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            return;
        }

        return $user;
    }
}