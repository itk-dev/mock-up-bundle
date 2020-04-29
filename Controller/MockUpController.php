<?php

/*
 * This file is part of itk-dev/mock-up-bundle.
 *
 * (c) 2020 ITK Development
 *
 * This source file is subject to the MIT license.
 */

namespace ItkDev\MockUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

class MockUpController extends AbstractController
{
    /** @var LoaderInterface */
    private $loader;

    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    public function index(string $path): Response
    {
        $parameters = [];
        if (empty($path)) {
            $path = 'index';

            if ($this->loader instanceof FilesystemLoader) {
                $pattern = '/\.html\.twig$/';
                $paths = array_map(static function (string $path) {
                    return $path.'/mock-up';
                }, $this->loader->getPaths());
                $paths = array_filter($paths, static function (string $path) {
                    return is_dir($path);
                });
                $finder = (new Finder())
                    ->in($paths)
                    ->filter(static function (SplFileInfo $file) use ($pattern) {
                        return false === strpos($file->getPathname(), '_')
                            && false === strpos($file->getFilename(), 'index.html.twig')
                            && 1 === preg_match($pattern, $file->getFilename());
                    });
                $parameters['paths'] = [];
                /** @var SplFileInfo $file */
                foreach ($finder as $file) {
                    $parameters['paths'][] = preg_replace($pattern, '', $file->getRelativePathname());
                }
            }
        }

        $view = 'mock-up/'.$path.'.html.twig';
        if (!$this->loader->exists($view)) {
//            throw new NotFoundHttpException(sprintf('Cannot find view %s', $view));
        }

        return $this->render($view, $parameters);
    }
}
