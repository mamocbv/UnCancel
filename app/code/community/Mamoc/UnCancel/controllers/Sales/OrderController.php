<?php
class Mamoc_UnCancel_Sales_OrderController extends Mage_Adminhtml_Controller_Action{
	public function UncancelAction(){
		$Id = $this->getRequest()->getParam('id',false);

		if($Id){
			if(Mage::getSingleton('mmc_uncancel/uncancel')->uncancelOrder($Id)){
				$this->_getSession()->addSuccess($this->__('Order has been uncanceled.'));
			}else{
				$this->_getSession()->addError($this->__('Unable to uncancel order.'));
			}
		}
		$this->_redirect('*/*/');
	}

	public function massUncancelAction(){
        $orderIds = $this->getRequest()->getPost('order_ids', array());
        $countUnCancelOrder = 0;
        $countNonUnCancelOrder = 0;
        $uncancel = Mage::getModel('mmc_uncancel/uncancel');
        foreach ($orderIds as $orderId) {
            if ($uncancel->uncancelOrder($orderId)) {
                $countUnCancelOrder++;
            } else {
                $countNonUnCancelOrder++;
            }
        }
        if ($countNonUnCancelOrder) {
            if ($countUnCancelOrder) {
                $this->_getSession()->addError($this->__('%s order(s) cannot be uncanceled', $countNonUnCancelOrder));
            } else {
                $this->_getSession()->addError($this->__('The order(s) cannot be uncanceled'));
            }
        }
        if ($countUnCancelOrder) {
            $this->_getSession()->addSuccess($this->__('%s order(s) have been uncanceled.', $countUnCancelOrder));
        }
        $this->_redirect('*/*/');
    }

	protected function getSession(){
		return Mage::getSingleton('adminhtml/session');
	}
}
?>
