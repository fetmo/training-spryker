<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PriceProductStorage;

use Pyz\Client\PriceImport\Plugin\PriceProductCustomerPriceExtractorPlugin;
use Spryker\Client\Kernel\Container;
use Spryker\Client\PriceProductMerchantRelationshipStorage\Plugin\PriceProductStorageExtension\PriceProductMerchantRelationshipStorageDimensionPlugin;
use Spryker\Client\PriceProductStorage\PriceProductStorageDependencyProvider as SprykerPriceProductStorageDependencyProvider;
use Spryker\Client\PriceProductVolume\Plugin\PriceProductStorageExtension\PriceProductVolumeExtractorPlugin;

class PriceProductStorageDependencyProvider extends SprykerPriceProductStorageDependencyProvider
{
    const PRICE_IMPORT_CLIENT = 'client price import';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addPriceImportClient($container);

        return $container;
    }

    /**
     * @return \Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePriceDimensionPluginInterface[]
     */
    public function getPriceDimensionStorageReaderPlugins(): array
    {
        return [
            new PriceProductMerchantRelationshipStorageDimensionPlugin(),
        ];
    }

    protected function addPriceImportClient(Container $container): Container
    {
        $container->set(self::PRICE_IMPORT_CLIENT, $container->getLocator()->priceImport()->client());

        return $container;
    }

    /**
     * @return \Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePricesExtractorPluginInterface[]
     */
    protected function getPriceProductPricesExtractorPlugins(): array
    {
        return [
            new PriceProductVolumeExtractorPlugin(),
            new PriceProductCustomerPriceExtractorPlugin(),
        ];
    }
}
