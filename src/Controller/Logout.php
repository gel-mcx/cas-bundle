<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller;

use drupol\psrcas\CasInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class Logout.
 */
final class Logout extends AbstractController
{
    /**
     * @param \drupol\psrcas\CasInterface $cas
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(
        CasInterface $cas,
        TokenStorageInterface $tokenStorage
    ) {
        if (null !== $response = $cas->logout()) {
            $tokenStorage->setToken();

            return new RedirectResponse($response->getHeaderLine('location'));
        }

        return new RedirectResponse('/');
    }
}
