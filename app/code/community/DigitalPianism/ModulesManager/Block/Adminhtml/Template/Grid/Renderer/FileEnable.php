<?php

/**
 * Class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_FileEnable
 */
class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_FileEnable extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        $fileEnable = $row->getFileEnable();
        if ($fileEnable == "true")
        {
            return "<p class='pass'>".$fileEnable."</p>";
        }
        else return "<p class='error'>".$fileEnable."</p>";
    }
}
