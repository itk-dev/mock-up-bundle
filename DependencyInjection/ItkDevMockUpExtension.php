<?php

/*
 * This file is part of itk-dev/mock-up-bundle.
 *
 * (c) 2020 ITK Development
 *
 * This source file is subject to the MIT license.
 */

namespace ItkDev\MockUpBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class ItkDevMockUpExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
        $fileLocator = new FileLocator(\dirname(__DIR__));

        $container->loadFromExtension('twig', [
            'paths' => [
                $fileLocator->locate('Resources/views/') => '',
            ],
        ]);
    }

    public function load(array $configs, ContainerBuilder $builder)
    {
        $loader = new XmlFileLoader($builder, new FileLocator(\dirname(__DIR__).'/Resources/config'));
        $loader->load('services.xml');
    }
}
