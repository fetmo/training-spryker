<?php


namespace Pyz\Zed\PriceImport\Business\Model\Storage;


use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductStorage;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductStorageQuery;
use Pyz\Zed\PriceImport\Persistence\PriceImportRepository;

class Publisher
{
    private $repository;

    public function __construct(PriceImportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function publish(array $transfers): void
    {
        /** @var CustomerPriceProductTransfer $transfer */
        foreach ($transfers as $transfer) {
            $transfer->requireProductNumber();
            $transfer->requireCustomerNumber();

            $entries = $this->repository->fetchCustomerPricesByCustomerNoAndProductNo($transfer->getCustomerNumber(), $transfer->getProductNumber());

            $prices = [];
            /** @var CustomerPriceProductTransfer $model */
            foreach ($entries->getItems() as $model) {
                $prices[] = [
                    'quantity' => $model->getQuantity(),
                    'priceInCents' => $model->getPrice(),
                    #CustomerPriceProductTransfer::QUANTITY => $model->getQuantity(),
                    #CustomerPriceProductTransfer::PRICE => $model->getPrice(),
                ];
            }

            $this->saveToStorage($transfer, $prices);
        }
    }

    protected function saveToStorage(CustomerPriceProductTransfer $transfer, array $prices)
    {
        $query = new PyzCustomerPriceProductStorageQuery();
        $query->filterByCustomerPriceProductKey($this->generateKey($transfer))
            ->find()
            ->delete();

        try {
            $storageModel = new PyzCustomerPriceProductStorage();
            $storageModel->setData($prices);
            $storageModel->setCustomerPriceProductKey($this->generateKey($transfer));
            $storageModel->setKey($this->generateKey($transfer));
            $storageModel->setLocale('de_DE');
            $storageModel->save();
        } catch (\Exception $exception) {
            file_put_contents(__DIR__ . '/log.log', print_r($exception, true));
        }
    }

    protected function generateKey(CustomerPriceProductTransfer $transfer)
    {
        return sprintf('%s_%s', $transfer->getCustomerNumber(), $transfer->getProductNumber());
    }

}