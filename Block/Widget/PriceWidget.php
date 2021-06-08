<?php


namespace Study\LayoutBlock\Block\Widget;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Url\Helper\Data;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Model\ResourceModel\Product;


/**
 * Class PriceWidget
 * @package Study\LayoutBlock\Block\Widget
 */
class PriceWidget extends ListProduct implements BlockInterface
{
    /**
     * @var ProductFactory
     */
    protected $_productFactory;

    /**
     * @var Product
     */
    private $resourceModel;

    /**
     * PriceWidget constructor.
     * @param Context $context
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param ProductFactory $productFactory
     * @param CategoryRepositoryInterface $categoryRepository
     * @param Product $resourceModel
     * @param Data $urlHelper
     * @param array $data
     */
    public function __construct(Context $context,
                                PostHelper $postDataHelper,
                                Resolver $layerResolver,
                                ProductFactory $productFactory,
                                CategoryRepositoryInterface $categoryRepository,
                                \Magento\Catalog\Model\ResourceModel\Product $resourceModel,
                                Data $urlHelper, array $data = [])

    {
        $this->_productFactory = $productFactory;
        parent::__construct($context, $postDataHelper, $layerResolver,
            $categoryRepository, $urlHelper, $data);
        $this->setTemplate("Study_LayoutBlock::widget/priceWidget.phtml");
        $this->resourceModel = $resourceModel;
    }

    /**
     * @return \Magento\Catalog\Model\Product
     */
    public function getProductInformation()
    {
        $productId = $this->getProduct_id();
        try {
            if ($productId) {
                $productId = str_replace('product/', '', $productId);
            }
            $product = $this->_productFactory->create();
            $this->resourceModel->load($product, $productId);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error loading product'));
        }

        return $product;
    }
}
