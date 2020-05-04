<?php

namespace PyzTest\Zed\PriceImport\Business\Model;


use Codeception\Test\Unit;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProduct;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductQuery;
use Pyz\Zed\PriceImport\Business\PriceImportFacade;

/**
 * Auto-generated group annotations
 * @group PyzTest
 * @group Zed
 * @group PriceImport
 * @group Business
 * @group Model
 * @group JsonImporterTest
 * Add your own group annotations below this line
 */
class JsonImporterTest extends Unit
{

    public function testImportCreatePrices(): void
    {
        $facade = new PriceImportFacade();
        $filePath = __DIR__ . '/../../_data/test-1.json';

        $facade->runImport($filePath);

        $query = PyzCustomerPriceProductQuery::create()
            ->filterByCustomerNumber("27")
            ->filterByProductNumber("20");
        $prices = $query->find();

        $this->assertContainsOnlyInstancesOf(PyzCustomerPriceProduct::class, $prices);

        $this->assertCount(3, $prices);
    }

    public function testImportUpdatePrices(): void
    {
        $this->testImportCreatePrices();

        $facade = new PriceImportFacade();
        $filePath = __DIR__ . '/../../_data/test-2.json';

        $facade->runImport($filePath);

        $query = PyzCustomerPriceProductQuery::create()
            ->filterByCustomerNumber("27")
            ->filterByProductNumber("20")
            ->filterByQuantity(4)
        ;
        $price = $query->findOne();

        $this->assertInstanceOf(PyzCustomerPriceProduct::class, $price);
        $this->assertSame(10.10, $price->getPrice());
    }

}