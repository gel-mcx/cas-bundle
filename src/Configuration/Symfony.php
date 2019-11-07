<?php

declare(strict_types=1);

namespace drupol\CasBundle\Configuration;

use drupol\psrcas\Configuration\PropertiesInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use drupol\psrcas\Configuration\Properties as PsrCasConfiguration;

/**
 * Class Symfony.
 */
final class Symfony implements PropertiesInterface
{
    /**
     * @var \drupol\psrcas\Configuration\Properties
     */
    private $cas;

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * Symfony constructor.
     *
     * @param array $properties
     * @param \Symfony\Component\Routing\RouterInterface $router
     */
    public function __construct(array $properties, RouterInterface $router)
    {
        $this->router = $router;
        $this->cas = new PsrCasConfiguration($this->routeToUrl($properties));
    }

    /**
     * Transform Symfony routes into absolute URLs.
     *
     * @param array $properties
     *   The properties.
     *
     * @return array
     *   The updated properties.
     */
    private function routeToUrl(array $properties): array
    {
        foreach ($properties['protocol'] as $key => $protocol) {
            if (false === isset($protocol['default_parameters']['service'])) {
                continue;
            }

            $service = $protocol['default_parameters']['service'];

            if (false === filter_var($service, FILTER_VALIDATE_URL)) {
                $service = $this
                    ->router
                    ->generate(
                        $service,
                        [],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    );

                $properties['protocol'][$key]['default_parameters']['service'] = $service;
            }

        }

        return $properties;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->cas->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->cas->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->cas->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->cas->offsetUnset($offset);
    }
}
