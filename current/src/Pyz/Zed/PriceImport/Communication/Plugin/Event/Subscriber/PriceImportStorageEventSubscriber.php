<?php

namespace Pyz\Zed\PriceImport\Communication\Plugin\Event\Subscriber;

use Pyz\Zed\PriceImport\Communication\Plugin\Event\Listener\PriceImportKeyStoragePublishListener;
use Pyz\Zed\PriceImport\Communication\Plugin\Event\Listener\PriceImportStorageSaveListener;
use Pyz\Zed\PriceImport\Dependency\PriceImportEvents;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class PriceImportStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     * @api
     *
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(PriceImportEvents::PRICE_IMPORT_SAVE, new PriceImportStorageSaveListener());
        $eventCollection->addListenerQueued(PriceImportEvents::PRICE_IMPORT_STORAGE_SAVE, new PriceImportKeyStoragePublishListener());

        return $eventCollection;
    }
}