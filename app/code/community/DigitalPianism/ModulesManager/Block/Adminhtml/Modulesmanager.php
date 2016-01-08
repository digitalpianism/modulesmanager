<?php

/**
 * Class DigitalPianism_ModulesManager_Block_Adminhtml_Modulesmanager
 */
class DigitalPianism_ModulesManager_Block_Adminhtml_Modulesmanager extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_modulesmanager';
        $this->_blockGroup = 'modulesmanager';
        $this->_headerText = Mage::helper('modulesmanager')->__('Modules Details');
        parent::__construct();
        $this->_removeButton('add');
    }
}