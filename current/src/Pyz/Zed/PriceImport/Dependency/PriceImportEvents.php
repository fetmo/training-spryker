<?php

namespace Pyz\Zed\PriceImport\Dependency;

interface PriceImportEvents
{
    public const PRICE_IMPORT_SAVE = 'Entity.priceImport.save';
    public const PRICE_IMPORT_STORAGE_SAVE = 'Entity.priceImport.storage.save';
}