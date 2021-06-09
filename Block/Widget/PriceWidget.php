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

/**
 * Class PriceWidget
 * @package Study\LayoutBlock\Block\Widget
 */
class PriceWidget extends ListProduct implements BlockInterface
{
    /**
     * @var \Magento\Catalog\Model\ProductRepository
     */
    protected $_productRepository;

    /**
     * PriceWidget constructor.
     * @param Context $context
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param ProductFactory $productFactory
     * @param CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Catalog\Model\ProductRepository $productRepository
     * @param Data $urlHelper
     * @param array $data
     */
    public function __construct(Context $context,
                                PostHelper $postDataHelper,
                                Resolver $layerResolver,
                                ProductFactory $productFactory,
                                CategoryRepositoryInterface $categoryRepository,
                                \Magento\Catalog\Model\ProductRepository $productRepository,
                                Data $urlHelper, array $data = [])

    {
        $this->_productFactory = $productFactory;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
        $this->_productRepository = $productRepository;
    }

    /**
     * @param $sku
     * @return \Magento\Catalog\Api\Data\ProductInterface|\Magento\Catalog\Model\Product
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductBySku($sku)
    {
        return $this->_productRepository->get($sku);
    }

    /**
     * @return false|float|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function showProductPrice()
    {
        $sku = $this->getData('title_sku_product');
        $product = $this->getProductBySku($sku);
        $productPrice = $product->getPrice();
        if($this->getData('use_special_price') && (!empty($product->getSpecialPrice()))){
        $productPrice = $product->getSpecialPrice();
        }
        if($this->getData('round_of_the_price')){
            $productPrice = ceil($productPrice);
        }

        return $productPrice;
    }

    /**
     * @return false|float|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function toHtml()
    {
        return $this->showProductPrice();
    }
}
