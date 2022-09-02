<?php

namespace Icube\Training\Block\Adminhtml\Index\NewAction;

use \Magento\Backend\Block\Widget\Context;

class GenericButton
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Backend\Model\UrlInterface $urlInterface,
        array $data = []
        )
    {
        $this->urlInterface = $urlInterface;
        $this->context = $context;
        $this->request = $request;
        // parent::__construct($context, $data);
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}

