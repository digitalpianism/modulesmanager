<?php

/**
 * Class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_Version
 */
class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_Version extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        $version = $row->getVersion();
        if ($version != $row->getDataVersion() && $row->getDataEntry())
        {
            return "<p class='error'>".$version."</p>";
        }
        else return $version;
    }
}
