<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1588583435.
 * Generated on 2020-05-04 09:10:35 by root
 */
class PropelMigration_1588583435
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'zed' => '
BEGIN;

ALTER TABLE "pyz_customer_price_product"

  ADD "id_customer_price_product" INTEGER NOT NULL,

  ADD PRIMARY KEY ("id_customer_price_product");

COMMIT;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'zed' => '
BEGIN;

ALTER TABLE "pyz_customer_price_product"

  DROP CONSTRAINT "pyz_customer_price_product_pkey",

  DROP COLUMN "id_customer_price_product";

COMMIT;
',
);
    }

}