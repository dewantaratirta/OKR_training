<?php

namespace Icube\Training\Block\Adminhtml\Index\NewAction;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        if ($this->request->getParam('id')) {
            # code...
            return [
                'label' => __('Delete'),
                'on_click' => 'deleteConfirm(\'' . __('Are you sure you want to delete this contact ?') . '\', \'' . $this->getDeleteUrl() . '\')',
                'class' => 'delete',
                'sort_order' => -1,
            ];
        }
    }

    public function getDeleteUrl() { 
        $id = $this->request->getParam('id');
        // echo $this->getUrl('*/*/delete/', ['id' => $id]);

        # arahkan ke controller bawa id
        return $this->getUrl('*/*/delete/', ['id' => $id]); 
    }
    
}

