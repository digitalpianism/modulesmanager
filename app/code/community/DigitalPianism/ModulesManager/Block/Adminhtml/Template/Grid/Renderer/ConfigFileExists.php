<?php

/**
 * Class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_ConfigFileExists
 */
class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_ConfigFileExists extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        $fileExists = $row->getConfigFileExists();
        if ($fileExists == "false")
        {
            return "<p class='error'>".Mage::helper('modulesmanager')->__('%s does not exist',$row->getConfigFilePath())."</p>";
        }
        else return "<p class='pass'>".$fileExists."</p>";
    }
}
