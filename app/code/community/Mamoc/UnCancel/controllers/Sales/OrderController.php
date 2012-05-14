<?php
class Mamoc_UnCancel_Sales_OrderController extends Mage_Adminhtml_Controller_Action{
	public function UncancelAction(){
		$Id = $this->getRequest()->getParam('id',false);

		if($Id){
			if(Mage::getSingleton('mmc_uncancel/uncancel')->uncancelOrder($Id)){
				$this->_getSession()->addSuccess($this->__('Your order has been uncanceled.'));
			}else{
				$this->_getSession()->addError($this->__('Unable to uncancel your order.'));
			}
		}
		$this->_redirect('*/*/');
	}

	public function massCancelAction()    {
        $orderIds = $this->getRequest()->getPost('order_ids', array());
        $countCancelOrder = 0;
        $countNonCancelOrder = 0;
        foreach ($orderIds as $orderId) {
            $uncancel = Mage::getModel('mmc_uncancel/uncancel');
            if ($uncancel->uncancelOrder($orderId)) {
                $countCancelOrder++;
            } else {
                $countNonCancelOrder++;
            }
        }
        if ($countNonCancelOrder) {
            if ($countCancelOrder) {
                $this->_getSession()->addError($this->__('%s order(s) cannot be uncanceled', $countNonCancelOrder));
            } else {
                $this->_getSession()->addError($this->__('The order(s) cannot be uncanceled'));
            }
        }
        if ($countCancelOrder) {
            $this->_getSession()->addSuccess($this->__('%s order(s) have been uncanceled.', $countCancelOrder));
        }
        $this->_redirect('*/*/');
    }

	protected function getSession(){
		return Mage::getSingleton('adminhtml/session');
	}
}
?>
