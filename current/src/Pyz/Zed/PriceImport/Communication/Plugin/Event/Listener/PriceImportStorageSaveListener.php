<?php

namespace Pyz\Zed\PriceImport\Communication\Plugin\Event\Listener;

use Pyz\Zed\PriceImport\Business\PriceImportFacade;
use Pyz\Zed\PriceImport\Dependency\PriceImportEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method PriceImportFacade getFacade()
 */
class PriceImportStorageSaveListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * Specification
     *  - Listeners needs to implement this interface to execute the codes for more
     *  than one event at same time (Bulk Operation)
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface[] $transfers
     * @param string $eventName
     *
     * @return void
     * @api
     *
     */
    public function handleBulk(array $transfers, $eventName)
    {
        /** @var \Generated\Shared\Transfer\CustomerPriceProductListTransfer $importList */
        foreach ($transfers as $importList) {
            /** @var \Generated\Shared\Transfer\CustomerPriceProductTransfer $transfer */
            foreach ($importList->getItems() as $transfer) {
                $this->getFacade()->saveCustomerPriceImport($transfer);
                $this->getFacade()->triggerEvent(PriceImportEvents::PRICE_IMPORT_STORAGE_SAVE, $transfer);
            }
        }
    }
}