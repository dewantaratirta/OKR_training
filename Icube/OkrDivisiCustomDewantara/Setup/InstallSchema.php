<?php

namespace Icube\OkrDivisiCustomDewantara\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

// Detail entity Acara
// - nama
// - pemateri
// - peserta
// Detail Peserta :
//  - nama
 
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        # create table acara
        $table = $setup->getConnection()->newTable($setup->getTable('icube_acara_dewantara'))
        ->addColumn( 'id_acara', Table::TYPE_INTEGER, 4, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'ID Acara')
        ->addColumn('nama', Table::TYPE_TEXT,255,[], 'Nama')
        ->addColumn('pemateri', Table::TYPE_TEXT,255,[], 'Pemateri');
        $setup->getConnection()->createTable($table);

        # create table peserta
        $table2 = $setup->getConnection()->newTable($setup->getTable('icube_peserta_dewantara'))
        ->addColumn( 'id_peserta',Table::TYPE_INTEGER,4,['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],'ID Acara')
        ->addColumn('id_acara',Table::TYPE_INTEGER,4,[],'Nama')
        ->addColumn('nama',Table::TYPE_TEXT,255,[],'Nama');
        $setup->getConnection()->createTable($table2);

        $setup->endSetup();
    }
}
