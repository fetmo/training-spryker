<?php


namespace Pyz\Client\PriceImport;


use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class PriceImportDependencyProvider extends AbstractDependencyProvider
{

    const STORAGE_CLIENT = 'storage client';

    public function provideServiceLayerDependencies(Container $container)
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addStorageClient($container);

        return $container;
    }

    protected function addStorageClient(Container $container)
    {
        $container->set(self::STORAGE_CLIENT, $container->getLocator()->storage()->client());

        return $container;
    }

}