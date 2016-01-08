<?php

/**
 * Class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_DataEntry
 */
class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_DataEntry extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        $dataEntry = $row->getDataEntry();
        if (!$dataEntry)
        {
            return "<p class='notapplicable'>".$dataEntry."</p>";
        }
        else return $dataEntry;
    }
}
