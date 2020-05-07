<?php

namespace Pyz\Zed\PriceImport\Communication\Plugin\Event\Listener;


use Pyz\Zed\PriceImport\Business\PriceImportFacade;
use Pyz\Zed\PriceImport\Communication\PriceImportCommunicationFactory;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method PriceImportFacade getFacade()
 */
class PriceImportKeyStoragePublishListener extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * Specification
     *  - Listeners needs to implement this interface to execute the codes for each
     *  event.
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param string $eventName
     *
     * @return void
     * @api
     *
     */public function handle(TransferInterface $transfer, $eventName)
    {
        $this->getFacade()->publish([$transfer]);
    }
}