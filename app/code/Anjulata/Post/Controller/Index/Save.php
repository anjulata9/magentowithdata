<?php
namespace Anjulata\Post\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Anjulata\Post\Model\PostFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Filesystem; 
use Magento\Framework\App\Filesystem\DirectoryList;
class Save extends Action
{

    protected $_modelPostFactory;
    protected $resultPageFactory;
    protected $_sessionManager;
    protected $_filesystem;

    public function __construct(
        Context $context,
        PostFactory $modelPostFactory,
        PageFactory  $resultPageFactory,
        SessionManagerInterface $sessionManager,
        \Magento\Framework\Filesystem $fileSystem
    )
    {
        parent::__construct($context);
        $this->_modelPostFactory = $modelPostFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
        $this->_filesystem = $fileSystem;
    }

    public function execute()
    {
        try{
        //echo "test";exit;
        $resultRedirect     = $this->resultRedirectFactory->create();
        //$PostModel          = $this->_modelPostFactory->create();
        $data               = $this->getRequest()->getPost();
        //print_r($data);exit;
        //$date               = date('Y-m-d h:i:sa');


        //echo "test";exit;
        $resultRedirect     = $this->resultRedirectFactory->create();
        if(isset($data['post_id'])){            
            $PostModel = $this->_modelPostFactory->create()->load($data['post_id']);
        }else{
            $PostModel          = $this->_modelPostFactory->create();
        }

        $result = array();
        if ($_FILES['featured_image']['name']) {
            try {
                // init uploader model.
                $uploader = $this->_objectManager->create(
                    'Magento\MediaStorage\Model\File\Uploader',
                    ['fileId' => 'featured_image']
                );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                // get media directory
                $mediaDirectory = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
                
                $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('t/o/');
                // save the image to media directory
                $result = $uploader->save($mediaDirectory->getAbsolutePath());
            } catch (Exception $e) {
                \Zend_Debug::dump($e->getMessage());
            }
            $path.=$result['name'];
            $PostModel->setData('featured_image', $path);
        }

        //print_r($result);
        
        //exit;
        
        $PostModel->setData('name', $data['name']);
        $PostModel->setData('url_key', $data['url_key']);
        $PostModel->setData('post_content', $data['post_content']);
        $PostModel->setData('tags', $data['tags']);
        $PostModel->setData('status', $data['status']);
        
        $PostModel->setData('email', $data['email']);
        $PostModel->setData('mobile', $data['mobile']);
        $PostModel->setData('cdate', $data['cdate']);
        $PostModel->setData('post_status', $data['post_status']);
        $PostModel->setData('radio_select', $data['radio_select']);
       // $PostModel->setData($data);

        $PostModel->save();

        $this->_redirect('post/index');
        $this->messageManager->addSuccessMessage(__('The data has been saved.'));
    }catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t add record, Please try again."));
        }
    }
}
