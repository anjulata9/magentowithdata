<?php

namespace Anjulata\Post\Block;
//use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\Controller\Result\RedirectFactory;
//use Magento\Framework\View\Element\Template;
use Anjulata\Post\Model\PostFactory;
class Booking extends \Magento\Framework\View\Element\Template
{
    protected $formKey;
    protected $_pageFactory;
    protected $_coreRegistry;
    protected $_postLoader;
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Anjulata\Post\Model\PostFactory $postLoader,
        FormKey $formKey,
        array $data = []
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->formKey = $formKey;

        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_postLoader = $postLoader;

        parent::__construct($context, $data);
    }
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
        // companymodule is given in routes.xml
        // controller_name is folder name inside controller folder
        // action is php file name inside above controller_name folder

       // return 'm4/post/index/save';
        return $this->getUrl('post/index/save');
        // here controller_name is index, action is booking
    }
    
    public function getEditRecord()
    {
        /*$id = $this->_coreRegistry->registry('editRecordId');
        $post = $this->_postLoader->create();
        $result = $post->load($id);
        $result = $result->getData();
        return $result;*/

        $postid = $this->_request->getParam('id');
        $post = $this->_postLoader->create();
        $collection = $post->getCollection()->addFieldToFilter('post_id', $postid);
        return $collection->getData();
    }
}
