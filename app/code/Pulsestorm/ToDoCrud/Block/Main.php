<?php
namespace Pulsestorm\ToDoCrud\Block;
class Main extends \Magento\Framework\View\Element\Template
{
    protected $toDoFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Pulsestorm\ToDoCrud\Model\TodoItemFactory $toDoFactory
    )
    {
        $this->toDoFactory = $toDoFactory;
        parent::__construct($context);
    }

    function _prepareLayout() {
        $todo = $this->toDoFactory->create();
        $todo->setData('item_text', 'Finish my Magento article7777')
                ->save();
        $this->myGet();
        $this->getMyALL();
        echo '<h1>Work whith Collection</h1><hr>';
        $this->getMyCollection();
        var_dump('Done');
        exit;
    }
    public function myGet() {
        $todo = $this->toDoFactory->create();
        $todo = $todo->load(3);
        var_dump($todo->getData());
    }
    
    public function getMyALL(){
    $todo = $this->toDoFactory->create();
    $todo = $todo->load(1);        
    var_dump($todo->getData());
    var_dump($todo->getItemText());
    var_dump($todo->getData('item_text'));
    }
    
    public function getMyCollection() {
        $todo = $this->toDoFactory->create();
        $collection = $todo->getCollection();
        foreach ($collection as $item) {
            var_dump('Item ID: ' . $item->getId());
            var_dump($item->getData());
        }
    }

}
