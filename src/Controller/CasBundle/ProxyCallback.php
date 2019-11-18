<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller\CasBundle;

use drupol\psrcas\CasInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProxyCallback.
 */
final class ProxyCallback extends AbstractController
{
    /**
     * @Route("/cas/proxy/callback", name="cas_bundle_proxy_callback")
     *
     * @param \drupol\psrcas\CasInterface $casProtocol
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(CasInterface $casProtocol)
    {
        return $casProtocol->handleProxyCallback();
    }
}
