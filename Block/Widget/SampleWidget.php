<?php


namespace Study\LayoutBlock\Block\Widget;


use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class SampleWidget
 * @package Study\LayoutBlock\Block\Widget
 */
class SampleWidget extends Template implements BlockInterface
{
    protected $_template = "widget/sample-widget.phtml";
}
