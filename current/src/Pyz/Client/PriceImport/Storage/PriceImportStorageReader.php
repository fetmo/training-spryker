<?php


namespace Pyz\Client\PriceImport\Storage;


use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Spryker\Client\Storage\StorageClientInterface;

class PriceImportStorageReader implements PriceImportStorageReaderInterface
{

    /**
     * @var \Spryker\Client\Storage\StorageClientInterface
     */
    private $storageClient;

    /**
     * @var \Pyz\Client\PriceImport\Storage\PriceImportKeyGeneratorInterface
     */
    private $keyGenerator;

    /**
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     * @param \Pyz\Client\PriceImport\Storage\PriceImportKeyGeneratorInterface $keyGenerator
     */
    public function __construct(StorageClientInterface $storageClient, PriceImportKeyGeneratorInterface $keyGenerator)
    {
        $this->storageClient = $storageClient;
        $this->keyGenerator = $keyGenerator;
    }

    /**
     * @param $idProductAbstract
     *
     * @return CustomerPriceProductTransfer[]|array
     */
    public function findPriceProductAbstractPrices($idProductAbstract): array
    {
        $priceData = [];

        $storageKey = $this->keyGenerator->generateStorageKey(
            $idProductAbstract
        );
        $storageData = (array)$this->storageClient->get($storageKey);
        #$storageData = [
        #    [
        #        'quantity' => 1,
        #        'priceInCents' => 5999
        #    ],
        #    [
        #        'quantity' => 50,
        #        'priceInCents' => 4999
        #    ]
        #];

        unset($storageData['_timestamp']);

        foreach ($storageData as $price) {
            $priceTransfer = new CustomerPriceProductTransfer();
            #$priceTransfer->fromArray($price);
            $priceTransfer->setPrice($price['priceInCents']);
            $priceTransfer->setQuantity($price['quantity']);

            $priceData[] = $priceTransfer;
        }

        return $priceData;
    }
    
}