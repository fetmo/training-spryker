<?php


namespace Pyz\Client\PriceProductStorage\Storage;


use Pyz\Client\PriceImport\PriceImportClient;
use Pyz\Client\PriceImport\Storage\PriceImportStorageReaderInterface;
use Spryker\Client\PriceProductStorage\Storage\PriceAbstractStorageReaderInterface;

class PriceAbstractStorageReader implements PriceAbstractStorageReaderInterface
{
    /**
     * @var \Spryker\Client\PriceProductStorage\Storage\PriceAbstractStorageReaderInterface
     */
    private $reader;

    private $customerPriceClient;

    public function __construct(PriceAbstractStorageReaderInterface $parentAbstractReader, PriceImportClient $importPriceClient)
    {
        $this->reader = $parentAbstractReader;
        $this->customerPriceClient = $importPriceClient;
    }

    /**
     * {@inheritDoc}
     */
    public function findPriceProductAbstractTransfers(int $idProductAbstract): array
    {
        $customerPrices = $this->customerPriceClient->findPriceProductAbstractPrices($idProductAbstract);

        $amount = 0;
        if (count($customerPrices) > 0){
            /** @var \Generated\Shared\Transfer\CustomerPriceProductTransfer $customerPrice */
            $customerPrice = $customerPrices[0];
            $amount = $customerPrice->getPrice();
        }

        $transfers = $this->reader->findPriceProductAbstractTransfers($idProductAbstract);

        if ($amount != 0) {
            foreach ($transfers as $transfer) {
                $moneyValue = $transfer->getMoneyValue();

                $moneyValue->setGrossAmount($amount);
                $moneyValue->setNetAmount($amount);

                $transfer->setMoneyValue($moneyValue);
            }
        }

        return $transfers;
    }
}
