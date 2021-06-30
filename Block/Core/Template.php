<?php 
class Block_Core_Template{

    protected $template = null;
    protected $layout = null;
    protected $message = null;
    protected $children = [];

    public function __construct()
    {
        
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function toHtml()
    {
        require_once $this->getTemplate();
    }
    
    public function createBlock($className)
    {
        $block = Ccc::objectManager($className);

        return $block;
    }

    public function getChildHtml($key)
    {
        $child = $this->getChild($key);
        if(!$child){
            return null;
        }
        return $child->toHtml();
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }
    public function getLayout()
    {
       return $this->layout;
    }

    public function setChildren(array $children )
    {
        $this->children = $children;
        return $this;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChild($child,$key)
    {
        $this->children[$key] = $child;
        return $this;
    }
    public function getChild($key)
    {
        if(!array_key_exists($key,$this->children)){
            return null;
        }
        return $this->children[$key];
    }

    public function removeChild($key)
    {
        if(array_key_exists($key,$this->children)){
            unset($this->children[$key]);
        }

        return $this;
    }

}