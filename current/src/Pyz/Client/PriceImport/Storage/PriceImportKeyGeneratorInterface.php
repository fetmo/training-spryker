<?php


namespace Pyz\Client\PriceImport\Storage;


interface PriceImportKeyGeneratorInterface
{

    public function generateStorageKey($productId);
}