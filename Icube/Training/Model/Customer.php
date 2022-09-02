<?php
namespace Icube\Training\Model;

class Customer extends \Magento\Customer\Model\Customer
{

    public function _construct()
    {
    }

    /**
     * Get full customer name
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getName()
    {
        $name  = ' 🏌️ ';
        $name .= $this->getFirstname();
        if ($this->_config->getAttribute('customer', 'middlename')->getIsVisible() && $this->getMiddlename()) {
            $name .= ' ' . $this->getMiddlename();
        }
        $name .= ' ' . $this->getLastname();
        if ($this->_config->getAttribute('customer', 'suffix')->getIsVisible() && $this->getSuffix()) {
            $name .= ' ' . $this->getSuffix();
        }
        return $name;
    }
}
