<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller\Cas;

use drupol\psrcas\CasInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProxyCallback.
 */
class ProxyCallback extends AbstractController
{
    /**
     * @Route("/cas/proxy/callback", name="cas_bundle_proxy_callback")
     *
     * @param \drupol\psrcas\CasInterface $casProtocol
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function proxyCallbackHandler(CasInterface $casProtocol)
    {
        return $casProtocol->handleProxyCallback();
    }
}
