<?php


namespace Pyz\Client\PriceImport\Storage;


class PriceImportKeyGenerator implements PriceImportKeyGeneratorInterface
{

    public function generateStorageKey($productId)
    {
        return 'price_import:de_de:28_30';
    }

}