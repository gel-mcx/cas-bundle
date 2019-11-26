<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller\CasBundle;

use drupol\psrcas\CasInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ProxyCallback.
 */
final class ProxyCallback extends AbstractController
{
    /**
     * @param \drupol\psrcas\CasInterface $casProtocol
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(CasInterface $casProtocol)
    {
        return $casProtocol->handleProxyCallback();
    }
}
