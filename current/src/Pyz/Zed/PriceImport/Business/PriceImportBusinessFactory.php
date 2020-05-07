<?php


namespace Pyz\Zed\PriceImport\Business;


use Pyz\Zed\PriceImport\Business\Model\JsonImporter;
use Pyz\Zed\PriceImport\Business\Model\Storage\Publisher;
use Pyz\Zed\PriceImport\Business\Model\Writer;
use Pyz\Zed\PriceImport\PriceImportDependencyProvider;
use Spryker\Zed\Event\Business\EventFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager getEntityManager()
 * @method \Pyz\Zed\PriceImport\Persistence\PriceImportRepository getRepository()
 */
class PriceImportBusinessFactory extends AbstractBusinessFactory
{

    public function createImporter(): JsonImporter
    {
        return new JsonImporter(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getEventFacade()
        );
    }

    public function createWriter()
    {
        return new Writer(
            $this->getEntityManager()
        );
    }

    public function createPublisher()
    {
        return new Publisher(
            $this->getRepository()
        );
    }

    public function getEventFacade(): EventFacadeInterface
    {
        return $this->getProvidedDependency(PriceImportDependencyProvider::EVENT_FACADE);
    }

}