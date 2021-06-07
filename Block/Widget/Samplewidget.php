<?php


namespace Study\LayoutBlock\Block\Widget;


use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class Samplewidget
 * @package Study\LayoutBlock\Block\Widget
 */
class Samplewidget extends Template implements BlockInterface
{
    protected $_template = "widget/samplewidget.phtml";
}
