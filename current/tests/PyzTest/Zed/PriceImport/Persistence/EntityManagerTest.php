<?php


namespace PyzTest\Zed\PriceImport\Persistence;


use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductQuery;
use Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager;

class EntityManagerTest extends Unit
{

    public function testImportFromTransfer()
    {
        $productPriceTransfer  = new CustomerPriceProductTransfer();
        $productPriceTransfer->setQuantity(10);
        $productPriceTransfer->setPrice(10.5);
        $productPriceTransfer->setProductNumber("25");
        $productPriceTransfer->setCustomerNumber("52");

        $entityManager = new PriceImportEntityManager();
        $entityManager->saveEntity($productPriceTransfer);

        $query = PyzCustomerPriceProductQuery::create()
            ->filterByCustomerNumber("52")
            ->filterByProductNumber("25");
        $prices = $query->find();

        $this->assertNotNull($prices);
        $this->assertCount(1, $prices);

        $priceOne = $prices[0];
        $this->assertSame(10, $priceOne->getQuantity());
        $this->assertSame(10.5, $priceOne->getPrice());
    }

}