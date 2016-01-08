<?php

class DigitalPianism_ModulesManager_Model_Feed extends Varien_Data_Collection
{
    public function load($printQuery = false, $logQuery = false)
    {
        // Skip if already loaded
        if ($this->isLoaded()) {
            return $this;
        }

        if (empty($this->_items)) {
            // Get the config
            $config = Mage::getConfig();

            // Loop through the modules
            foreach ($config->getNode('modules')->children() as $module) {
                // Create an object
                $item = new Varien_Object;

                // Module name
                $item->setName($module->getName());

                // Module Active
                $item->setFileEnable((string)$module->active);

                // Module Code Pool
                $item->setCodePool((string)$module->codePool);

                // Module Version
                $version = Mage::getConfig()->getModuleConfig($module->getName())->version ? Mage::getConfig()->getModuleConfig($module->getName())->version : "undefined";
                $item->setVersion($version);

                // Folder Path
                $dir = $config->getOptions()->getCodeDir().DS.$module->codePool.DS.uc_words($module->getName(),DS);
                $item->setFolderPath($dir);

                // Folder Exists
                $pathExists = (file_exists($dir) ? "true" : "false");
                $item->setFolderPathExists($pathExists);

                // Config File Exists
                $file = $config->getModuleDir('etc', $module->getName()).DS."config.xml";
                $item->setConfigFilePath($file);

                $exists = file_exists($file);

                if ($exists)
                {
                    // Get the config.xml file
                    $configXml = simplexml_load_string(file_get_contents($file),'Varien_Simplexml_Element');
                    // Get the resources tag
                    if ($nodes = $configXml->global->resources)
                    {
                        // Reset the pointer to the beginning of the array
                        reset($nodes);
                        // Get the resource name (first key in the array)
                        $resourceName = key($nodes);
                    }
                    else
                    {
                        $resourceName = '';
                    }

                    $item->setDataEntry($resourceName);

                    if (!$resourceName) $dataVersion = '';
                    else
                    {
                        // Get the data version based on the resource name
                        $dataVersion = Mage::getResourceSingleton('core/resource')->getDataVersion($resourceName);
                    }

                    $item->setDataVersion($dataVersion);

                    // Please note that the 0 value means Enabled and 1 means Disabled
                    $disableOutput = Mage::getStoreConfig('advanced/modules_disable_output/'.$module->getName()) ? 'false' : 'true';

                    $item->setOutputEnable($disableOutput);
                }
                else
                {
                    $item->setDataEntry('');
                    $item->setDataVersion('');
                    $item->setOutputEnable('');
                }

                $exists = $exists ? 'true' : 'false';
                $item->setConfigFileExists($exists);

                $this->addItem($item);
            }
        }
        $this->_setIsLoaded();
        $this->_renderFilters()->_renderOrders()->_renderLimit();
        return $this;
    }

    // This function is called by Magento when you type a text on a search field in a grid
    // $field : field we want to filter
    // $condition : Array ( [like] => Zend_Db_Expr Object ( [_expression:protected] => '%USER STRING%' ) )
    // It's the most classical type of condition, a string with a LIKE search like SQL, you can modify and
    // complete the code to implements other filters, if you do this, tell me on comments!
    public function addFieldToFilter($field, $condition = null)
    {
        $keyFilter = key($condition);
        $valueFilter = $condition[$keyFilter]->__toString();
        $this->addFilter($field,$valueFilter,'and');
        return $this;
    }

    protected function _renderFilters()
    {
        // If elements are already filtered, return this
        if ($this->_isFiltersRendered) {
            return $this;
        }

        foreach($this->_filters AS $filter){
            $keyFilter = $filter->getData()['field'];
            $valueFilter = substr($filter->getData()['value'],2,-2); // Delete '% AND %' of the string
            $condFilter = $filter->getData()['type']; // not used in this example

            // Loop you're item collection
            foreach($this->_items AS $key => $item){

                // If it's not an array, we use the search term to compare with the value of our item
                if(!is_array($item->{$keyFilter})){
                    if(!(strpos(strtolower($item->{$keyFilter}),strtolower($valueFilter)) !== FALSE)){
                        unset($this->_items[$key]);
                        // If search term not founded, unset the item to not display it!
                    }
                } else {
                    // If it's an array
                    $founded = false;
                    foreach($item->{$keyFilter} AS $valeur){
                        if(strpos(strtolower($valeur),strtolower($valueFilter)) !== FALSE){
                            $founded = true;
                        }
                    }
                    if(!$founded)
                        unset($this->_items[$key]); // Not founded in the array, so unset the item
                }
            }

        }

        $this->_isFiltersRendered = true;
        return $this;
    }

    protected function _renderOrders()
    {
        $keySort = key($this->_orders);
        $keyDirection = $this->_orders[$keySort];
        // We sort our items tab with a custom function AT THE BOTTOM OF THIS CODE
        usort($this->_items, $this->_build_sorter($keySort,$keyDirection));
        return $this;
    }

    protected function _renderLimit()
    {
        if ($this->_pageSize) {
            $currentPage = $this->getCurPage();
            $pageSize = $this->_pageSize;
            $firstItem = (($currentPage - 1) * $pageSize + 1);
            $lastItem = $firstItem + $pageSize;
            $iterator = 1;
            foreach ($this->getItems() as $key => $item) {
                $pos = $iterator;
                $iterator++;
                if ($pos >= $firstItem && $pos <= $lastItem) {
                    continue;
                }
                $this->removeItemByKey($key);
            }
        }
        return $this;
    }

    protected function _build_sorter($key,$direction) {
        return function ($a, $b) use ($key,$direction) {
            if ($direction == self::SORT_ORDER_ASC)
                return strnatcmp($a[$key], $b[$key]); // Natural comparaison of string
            else
                return -1 * strnatcmp($a[$key], $b[$key]); // reverse the result if sort order desc !
        };
    }
}