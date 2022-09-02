<?php

namespace Icube\OkrDivisiCustomDewantaraOverride\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Add [tanggal_acara] on Table icube_acara_dewantara
 * 
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (!$setup->tableExists('icube_acara_dewantara')) return;

        $connection = $setup->getConnection();
        $connection->addColumn(
            $setup->getTable('icube_acara_dewantara'),
            'tanggal_acara',
            [
                'type'      => Table::TYPE_DATETIME,
                'length'    => null,
                'nullable'  => true,
                'default'   => null,
                'comment'   => 'Tanggal Acara'
            ]
        );
    }
}
