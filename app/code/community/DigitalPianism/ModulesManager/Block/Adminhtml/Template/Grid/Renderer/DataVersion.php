<?php

/**
 * Class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_DataVersion
 */
class DigitalPianism_ModulesManager_Block_Adminhtml_Template_Grid_Renderer_DataVersion extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        $dataVersion = $row->getDataVersion();
        if ($dataVersion != $row->getVersion() && $row->getDataEntry())
        {
            return "<p class='error'>".$dataVersion."</p>";
        }
        elseif (!$dataVersion)
        {
            return "<p class='notapplicable'>".$dataVersion."</p>";
        }
        else return $dataVersion;
    }
}
