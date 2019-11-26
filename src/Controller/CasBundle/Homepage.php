<?php

declare(strict_types=1);

namespace drupol\CasBundle\Controller\CasBundle;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Homepage.
 */
final class Homepage
{
    /**
     * @Route("/cas/homepage", name="cas_bundle_homepage")
     */
    public function __invoke()
    {
        return new Response('You have been redirected here by default. Please update your configuration and replace <code>cas_bundle_homepage</code> with an existing route of your app.');
    }
}
