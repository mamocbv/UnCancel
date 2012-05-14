<?php
class Mamoc_UnCancel_Model_Observer{

    public function addbutton($observer) {

		Mage::log($observer->getEvent()->getBlock());
		if($observer->getEvent()->getBlock() instanceof Mage_Adminhtml_Block_Widget_Form_Container) {

			$item = $observer->getEvent()->getBlock()->getRequest()->getControllerName();

		Mage::log($item);

		}
    }

}
?>