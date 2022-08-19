<?php
namespace Nazmul\HelloWorld\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {
    protected $_registry;

    protected $_categoryFactory;

    protected $toolbarMemorizer;

    protected $_request;

    public function __construct(
            \Magento\Framework\App\Helper\Context $context,
            \Magento\Framework\Registry $registry,
            \Magento\Catalog\Model\CategoryFactory $categoryFactory,
            \Magento\Catalog\Model\Product\ProductList\ToolbarMemorizer $toolbarMemorizer,
            \Magento\Framework\App\Request\Http $request
        ){
            $this->_registry = $registry;
            $this->_categoryFactory = $categoryFactory;
            $this->toolbarMemorizer = $toolbarMemorizer;
            $this->_request = $request;
            parent::__construct($context);
        }

        public function getFullActionName()
        {

            return $this->_request->getFullActionName();

        }

        public function getMemorizeMode(){
            $memorizeMode = $this->toolbarMemorizer->getMode();
            if($memorizeMode == ''){
                $memorizeMode = 'list';
            } else {
                $memorizeMode = '';
            }

            return $memorizeMode;
        }


        public function getCurrentCategory()
        {        
            return $this->_registry->registry('current_category');
        }

        /* Get category object */
        public function getCategory($categoryId)
        {
            $category = $this->_categoryFactory->create()->load($categoryId);
            return $category;
        }

        /* Get parent category object  */
        public function getParentCategory($categoryId)
        {
            return $this->getCategory($categoryId)->getParentCategory();
        }

        public function getName()
        {	$om = \Magento\Framework\App\ObjectManager::getInstance();
            $customerSession = $om->get('Magento\Customer\Model\Session');
            $customerSession->getCustomer()->getName();
            // return $this->_httpContext->getValue('customer_email');
            // return $this->customerSession->getCustomer()->getName();
        }
        
}