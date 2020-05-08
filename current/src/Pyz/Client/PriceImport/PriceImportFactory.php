<?php


namespace Pyz\Client\PriceImport;


use Pyz\Client\PriceImport\Storage\PriceImportKeyGenerator;
use Pyz\Client\PriceImport\Storage\PriceImportKeyGeneratorInterface;
use Pyz\Client\PriceImport\Storage\PriceImportStorageReader;
use Pyz\Client\PriceImport\Storage\PriceImportStorageReaderInterface;
use Spryker\Client\Kernel\AbstractFactory;

class PriceImportFactory extends AbstractFactory
{

    /**
     * @return \Pyz\Client\PriceImport\Storage\PriceImportStorageReaderInterface
     */
    public function createPriceImportStorageReader(): PriceImportStorageReaderInterface
    {
        return new PriceImportStorageReader(
            $this->getRedisClient(),
            $this->createPriceImportKeyGenerator()
        );
    }

    /**
     * @return \Pyz\Client\PriceImport\Storage\PriceImportKeyGeneratorInterface
     */
    protected function createPriceImportKeyGenerator(): PriceImportKeyGeneratorInterface
    {
        return new PriceImportKeyGenerator();
    }

    protected function getRedisClient()
    {
        return $this->getProvidedDependency(PriceImportDependencyProvider::STORAGE_CLIENT);
    }

}