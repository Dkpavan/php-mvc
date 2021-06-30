<?php
Ccc::loadFile("Model/Category.php");
Ccc::loadFile("Controller/Core/Abstract.php");

class Controller_Category extends Controller_Core_Abstract
{
    public function gridAction()
    {
        try {
            $this->getLayout();
            $gridBlock = $this->getLayout()->createblock("Block_Category_Grid")->setCategories();
            $this->getLayout()->addContent($gridBlock,"grid");
            $this->renderLayout();
        }
        catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function addAction()
    {
        try {
            $category = new Model_Category();
            $this->getLayout();
            $addBlock = $this->getLayout()->createblock("Block_Category_Edit")->setCategory($category);
            $this->getLayout()->addContent($addBlock,"edit");
            $this->renderLayout();
        }
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }

    }

    public function editAction()
    {
        try {
            $id = $this->getRequest()->getParams("id");
            $category = new Model_Category();
            $category = $category->load($id);

            if(!$category->getId()){
                throw new Exception("Record not found", 1);
            }

            $this->getLayout();
            $editBlock = $this->getLayout()->createblock("Block_Category_Edit")->setCategory($category);
            $this->getLayout()->addContent($editBlock,"edit");
            $this->renderLayout();
        } 
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }
    }

    public function saveAction()
    {
        try {

            if (!$this->getRequest()->isPost()) {
                throw new Exception("invalid request", 1);
            }

            $postData = $this->getRequest()->getPost('Category');
            if(!$postData){
                throw new Exception("No data posted.", 1);
            }

            $id = $this->getRequest()->getParams('id');
            $category = new Model_Category();

            if ($id) { 
                $category = $category->load($id);
                if (!$category) {
                    throw new Exception("unable to find record", 1);     
                }

                $category = $category->setData($postData);
                $category->updateChildrenPathIds();
                $category = $category->updateCategoryPathId();
            }
            else{
                $category->setData($postData);
                $category->save();
                $lastInsertId = $category->categoryId;
                $category->load($lastInsertId);
                $category = $category->updateCategoryPathId();
            }

            if($category){
                $this->getMessage()->setSuccess("Save Successfully");
            }
            else{
                $this->getMessage()->setFailure("Unable to Save the Data");
            } 
            $this->redirect("grid");
        } 
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid");
        }

    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getParams('id');
            $category = new Model_Category();
            $category = $category->load($id);
            if(!$category->getId()){
                throw new Exception("Record not found", 1);  
            }

            //------------current category delete with all the chlid----------//
            if ($this->getRequest()->getParams('delete') == 'all') {
                $condition = "`pathIds` like '%/{$id}' or `pathIds` like '{$id}/%' or `pathIds` like '%/{$id}/%' or `pathIds` = '{$id}'";
                $query = "DELETE from `category` where {$condition}";
                $result = $category->delete($query);
            }
    
            //------------ only current category delete----------//
            if ($this->getRequest()->getParams('delete') == 'one') {
                $category = $category->load($id);
                $category->updateChildrenPathIds();
                $result = $category->delete();
            }

            if ($result) {
                $this->getMessage()->setSuccess("Deleted Successfully");
            }
            else{
                $this->getMessage()->setFailure("unable to Delete Data");
            }
            $this->redirect("grid");
        }
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    } 
        
}


