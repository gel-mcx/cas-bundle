<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller\Cas;

use drupol\psrcas\CasInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Logout.
 */
class Logout extends AbstractController
{
    /**
     * @Route("/cas/logout", name="cas_bundle_logout")
     *
     * @param \drupol\psrcas\CasInterface $cas
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     *
     * @return \Psr\Http\Message\ResponseInterface|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function __invoke(
        CasInterface $cas,
        TokenStorageInterface $tokenStorage
    ) {
        $parameters = [];

        if (null !== $response = $cas->logout($parameters)) {
            $tokenStorage->setToken();

            return $response;
        }

        return new RedirectResponse('/');
    }
}
