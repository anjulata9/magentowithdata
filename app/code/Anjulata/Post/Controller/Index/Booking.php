<?php
namespace Anjulata\Post\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Booking extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_request;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->_coreRegistry = $coreRegistry;
        return parent::__construct($context);
    }
    /**
     * Booking action
     *
     * @return void
     */
    public function execute()
    {
        /*$this->_view->loadLayout();
        $this->_view->renderLayout();*/

        return $this->_pageFactory->create();

    }
}