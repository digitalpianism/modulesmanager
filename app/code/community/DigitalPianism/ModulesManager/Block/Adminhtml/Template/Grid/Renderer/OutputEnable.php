<?php

/**
 * Class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_OutputEnable
 */
class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_OutputEnable extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        $outputEnable = $row->getOutputEnable();
        if ($outputEnable == "true")
        {
            return "<p class='pass'>".$outputEnable."</p>";
        }
        else return "<p class='error'>".$outputEnable."</p>";
    }
}
