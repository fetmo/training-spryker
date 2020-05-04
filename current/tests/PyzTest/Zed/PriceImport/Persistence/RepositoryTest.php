<?php


namespace PyzTest\Zed\PriceImport\Persistence;


use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager;
use Pyz\Zed\PriceImport\Persistence\PriceImportRepository;

class RepositoryTest extends Unit
{

    public function testReadByCustomerNo()
    {
        $priceTransfer = new CustomerPriceProductTransfer();
        $priceTransfer->setPrice(10.2)
            ->setQuantity(10)
            ->setProductNumber("25")
            ->setCustomerNumber("64");

        $entityManager = new PriceImportEntityManager();
        $entityManager->saveEntity($priceTransfer);

        $priceRepository = new PriceImportRepository();
        $returnedPrices = $priceRepository->fetchCustomerPricesByCustomerNo("64");

        dump($returnedPrices);
    }

}