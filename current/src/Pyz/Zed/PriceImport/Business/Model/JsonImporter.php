<?php


namespace Pyz\Zed\PriceImport\Business\Model;


use Generated\Shared\Transfer\CustomerPriceProductListTransfer;
use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager;
use Pyz\Zed\PriceImport\Persistence\PriceImportRepository;

class JsonImporter
{

    /**
     * @var \Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager
     */
    private $entityManager;

    private $repository;

    /**
     * @param \Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager $entityManager
     */
    public function __construct(PriceImportEntityManager $entityManager, PriceImportRepository $reposiory)
    {
        $this->entityManager = $entityManager;
        $this->repository = $reposiory;
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
        foreach ($priceProductListTransfer->getItems() as $item) {
            $this->writeEntity($item);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerPriceProductTransfer $customerPriceProductTransfer
     */
    protected function writeEntity(CustomerPriceProductTransfer $customerPriceProductTransfer)
    {
        $this->entityManager->saveEntity($customerPriceProductTransfer);
    }
}
