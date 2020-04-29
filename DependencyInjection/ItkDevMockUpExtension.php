<?php

/*
 * This file is part of itk-dev/mock-up-bundle.
 *
 * (c) 2020 ITK Development
 *
 * This source file is subject to the MIT license.
 */

namespace ItkDev\MockUpBundle\DependencyInjection;

use ItkDev\UserBundle\User\UserManager;
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
//        header('content-type: text/plain'); echo var_export(null, true); die(__FILE__.':'.__LINE__.':'.__METHOD__);
        $loader = new XmlFileLoader($builder, new FileLocator(\dirname(__DIR__).'/Resources/config'));
        $loader->load('services.xml');

//        $configuration = new Configuration();
//        $config = $this->processConfiguration($configuration, $configs);
//        $definition = $builder->getDefinition(UserManager::class);
//        $definition->replaceArgument('$configuration', $config);
    }
}
