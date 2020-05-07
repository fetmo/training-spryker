<?php


namespace Pyz\Zed\PriceImport;


use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class PriceImportDependencyProvider extends AbstractBundleDependencyProvider
{
    public const EVENT_FACADE = 'FACADE_EVENT';

    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addEventFacade($container);

        return $container;
    }

    protected function addEventFacade(Container $container)
    {
        $container->set(self::EVENT_FACADE, $container->getLocator()->event()->facade());
        return $container;
    }
}
