<?php

namespace Icube\Training\Controller\Adminhtml\Trainee;

use Magento\Backend\App\Action;
use Icube\Training\Model\TraineeFactory;
use Magento\Backend\Model\Session;

class Save extends \Magento\Backend\App\Action
{
    protected $traineeFactory;
    protected $adminsession;

    public function __construct(
        Action\Context $context,
        TraineeFactory $traineeFactory,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->traineeFactory = $traineeFactory;
        $this->adminsession = $adminsession;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $traineeId = $this->getRequest()->getParam('entity_id');
            if ($traineeId) {
            	// var_dump($traineeId);die();
                $traineeModel = $this->traineeFactory->create()->load($traineeId);                
                $traineeModel->setData($data);
                try {
	                $traineeModel->save();
	                $this->messageManager->addSuccess(__('The data has been updated.'));
	                $this->adminsession->setFormData(false);
	                if ($this->getRequest()->getParam('back')) {
	                    if ($this->getRequest()->getParam('back') == 'save') {
	                        return $resultRedirect->setPath('*/*/edit');
	                    } else {
	                        return $resultRedirect->setPath(
	                            '*/*/edit',
	                            [
	                                'id' => $this->traineeFactory->getId(),
	                                '_current' => true
	                            ]
	                        );
	                    }
	                }
	                return $resultRedirect->setPath('*/*/index');
	            } catch (\Magento\Framework\Exception\LocalizedException $e) {
	                $this->messageManager->addError($e->getMessage());
	            } catch (\RuntimeException $e) {
	                $this->messageManager->addError($e->getMessage());
	            } catch (\Exception $e) {
	                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
	            }
            }

            $traineeModel = $this->traineeFactory->create();
            $traineeModel->setName($data['name']);
            $traineeModel->setDivision($data['division']);
            $traineeModel->setCreatedAt(date('now'));
            $traineeModel->save();
            $this->messageManager->addSuccess(__('The data has been saved.'));
            // return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/index');
    }
}