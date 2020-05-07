<?php


namespace Pyz\Zed\PriceImport\Business\Model;


use Generated\Shared\Transfer\CustomerPriceProductListTransfer;
use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Pyz\Zed\PriceImport\Dependency\PriceImportEvents;
use Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager;
use Pyz\Zed\PriceImport\Persistence\PriceImportRepository;
use Spryker\Zed\Event\Business\EventFacadeInterface;

class JsonImporter
{

    /**
     * @var \Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager
     */
    private $entityManager;

    private $repository;

    private $eventFacade;

    /**
     * @param \Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager $entityManager
     */
    public function __construct(PriceImportEntityManager $entityManager, PriceImportRepository $reposiory, EventFacadeInterface $eventFacade)
    {
        $this->entityManager = $entityManager;
        $this->repository = $reposiory;
        $this->eventFacade = $eventFacade;
    }

    /**
     * @param string $path
     */
    public function import(string $path)
    {
        $stringValue = file_get_contents($path);
        $parsed = json_decode($stringValue, true);
        $priceList = new CustomerPriceProductListTransfer();

        foreach ($parsed as $priceEntry) {
            $prices = $priceEntry['prices'];

            foreach ($prices as $price) {
                $customerPriceProductTransfer = new CustomerPriceProductTransfer();
                $customerPriceProductTransfer->setCustomerNumber($priceEntry['customer_number']);
                $customerPriceProductTransfer->setProductNumber($priceEntry['item_number']);
                $customerPriceProductTransfer->setQuantity($price['quantity']);

                $customerPriceProductTransfer = $this->repository->findCustomerPriceByTransfer($customerPriceProductTransfer);

                $customerPriceProductTransfer->setPrice($price['value']);

                $priceList->addItems($customerPriceProductTransfer);
            }
        }

        $this->saveList($priceList);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerPriceProductListTransfer $priceProductListTransfer
     */
    protected function saveList(CustomerPriceProductListTransfer $priceProductListTransfer)
    {
        $this->eventFacade->trigger(PriceImportEvents::PRICE_IMPORT_SAVE, $priceProductListTransfer);
    }
}
