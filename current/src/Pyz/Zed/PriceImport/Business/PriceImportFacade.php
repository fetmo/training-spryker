<?php


namespace Pyz\Zed\PriceImport\Business;


use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\PriceImport\Business\PriceImportBusinessFactory getFactory()
 */
class PriceImportFacade extends AbstractFacade
{

    public function runImport(string $path)
    {
        $this->getFactory()->createImporter()->import($path);
    }

    public function saveCustomerPriceImport(CustomerPriceProductTransfer $transfer)
    {
        $this->getFactory()->createWriter()->write($transfer);
    }

    public function triggerEvent(string $eventName, TransferInterface $transfer)
    {
        $this->getFactory()->getEventFacade()->trigger($eventName, $transfer);
    }

    public function publish(array $transfers)
    {
        $this->getFactory()->createPublisher()->publish($transfers);
    }
}
