<?php


namespace Pyz\Client\PriceImport;


use Pyz\Client\PriceImport\Storage\PriceImportKeyGenerator;
use Pyz\Client\PriceImport\Storage\PriceImportStorageReader;
use Spryker\Client\Kernel\AbstractFactory;

class PriceImportFactory extends AbstractFactory
{

    public function createPriceImportStorageReader()
    {
        return new PriceImportStorageReader(
            $this->getRedisClient(),
            $this->createPriceImportKeyGenerator()
        );
    }

    protected function createPriceImportKeyGenerator()
    {
        return new PriceImportKeyGenerator();
    }

    protected function getRedisClient()
    {
        return $this->getProvidedDependency(PriceImportDependencyProvider::STORAGE_CLIENT);
    }

}