<?php

/*
 * This file is part of itk-dev/mock-up-bundle.
 *
 * (c) 2020 ITK Development
 *
 * This source file is subject to the MIT license.
 */

namespace ItkDev\MockUpBundle;

use ItkDev\MockUpBundle\DependencyInjection\ItkDevMockUpExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ItkDevMockUpBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ItkDevMockUpExtension();
    }
}
