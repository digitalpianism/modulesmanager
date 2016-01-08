<?php

/**
 * Class DigitalPianism_ModulesManager_Block_Adminhtml_Modulesmanager_Grid
 * This is the block representing the grid of reports
 */
class DigitalPianism_ModulesManager_Block_Adminhtml_Modulesmanager_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     *	Constructor the grid
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('modulesmanagerGrid');
        $this->setDefaultSort('code_pool','DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     *	Prepare the collection to display in the grid
     */
    protected function _prepareCollection()
    {
        // Create a collection
        $collection = Mage::getSingleton('modulesmanager/feed');

        // We set the collection of the grid
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     *	Prepare the columns of the grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('name', array(
            'header' => Mage::helper('modulesmanager')->__('Name'),
            'index' => 'name'
        ));

        $this->addColumn('file_enable', array(
            'header' => Mage::helper('modulesmanager')->__('Active'),
            'index' => 'file_enable',
            'type' => 'options',
            'options' => array(
                "true" => Mage::helper('modulesmanager')->__('Yes'),
                "false" => Mage::helper('modulesmanager')->__('No')
            ),
            'renderer' => 'modulesmanager/adminhtml_template_grid_renderer_fileEnable'
        ));

        $this->addColumn('code_pool', array(
            'header' => Mage::helper('modulesmanager')->__('Code Pool'),
            'index' => 'code_pool',
            'renderer' => 'modulesmanager/adminhtml_template_grid_renderer_codePool'
        ));

        $this->addColumn('version', array(
            'header' => Mage::helper('modulesmanager')->__('Version'),
            'index' => 'version',
            'renderer' => 'modulesmanager/adminhtml_template_grid_renderer_version'
        ));

        $this->addColumn('folder_path', array(
            'header' => Mage::helper('modulesmanager')->__('Folder Path'),
            'index' => 'folder_path',
        ));

        $this->addColumn('folder_path_exists', array(
            'header' => Mage::helper('modulesmanager')->__('Folder Path Exists'),
            'index' => 'folder_path_exists',
            'type' => 'options',
            'options' => array(
                "true" => Mage::helper('modulesmanager')->__('Yes'),
                "false" => Mage::helper('modulesmanager')->__('No')
            ),
            'renderer' => 'modulesmanager/adminhtml_template_grid_renderer_folderPathExists'
        ));

        $this->addColumn('data_entry', array(
            'header' => Mage::helper('modulesmanager')->__('Data Entry'),
            'index' => 'data_entry',
            'renderer' => 'modulesmanager/adminhtml_template_grid_renderer_dataEntry'
        ));

        $this->addColumn('data_version', array(
            'header' => Mage::helper('modulesmanager')->__('Data Version'),
            'index' => 'data_version',
            'renderer' => 'modulesmanager/adminhtml_template_grid_renderer_dataVersion'
        ));

        $this->addColumn('output_enable', array(
            'header' => Mage::helper('modulesmanager')->__('Output Enable'),
            'index' => 'output_enable',
            'type' => 'options',
            'options' => array(
                "true" => Mage::helper('modulesmanager')->__('Yes'),
                "false" => Mage::helper('modulesmanager')->__('No')
            ),
            'renderer' => 'modulesmanager/adminhtml_template_grid_renderer_outputEnable'
        ));

        $this->addColumn('config_file_path', array(
            'header' => Mage::helper('modulesmanager')->__('Config File Path'),
            'index' => 'config_file_path'
        ));

        $this->addColumn('config_file_exists', array(
            'header' => Mage::helper('modulesmanager')->__('Config File Exists ?'),
            'index' => 'config_file_exists',
            'type' => 'options',
            'options' => array(
                "true" => Mage::helper('modulesmanager')->__('Yes'),
                "false" => Mage::helper('modulesmanager')->__('No')
            ),
            'renderer' => 'modulesmanager/adminhtml_template_grid_renderer_configFileExists'
        ));

        return $this;
    }

    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('head')->addItem('skin_css','css/digitalpianism/modulesmanager/styles.css');
        $this->getLayout()->getBlock('head')->addItem('skin_js','js/digitalpianism/modulesmanager/script.js');
        return parent::_prepareLayout();
    }
}
