<?php 
Ccc::loadFile("Block/Pages/Html.php");

class Model_Core_Layout
{
    protected $html = null;

    public function __construct()
    {
        $this->setHtml();
    }

    protected function setHtml()
    {
        $this->html = new Block_Pages_Html();
        $this->html->setLayout($this);
        $this->html->prepareChildren();
        return $this;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function renderLayout()
    {
        return $this->getHtml()->toHtml();
    }

    public function addContent($block,$key)
    {
        return $this->getHtml()->getChild('content')->addChild($block,$key);
    }
    
    public function createBlock($className)
    {
        $block = Ccc::objectManager($className);
        $block->setLayout($this);
        return $block;
    }

    
}