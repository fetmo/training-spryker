<?php


namespace Pyz\Client\PriceImport\Storage;


use Generated\Shared\Transfer\CustomerPriceProductTransfer;

interface PriceImportStorageReaderInterface
{

    /**
     * @param $idProductAbstract
     */
    public function findPriceProductAbstractPrices($idProductAbstract);
}