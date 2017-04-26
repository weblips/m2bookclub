<?php
namespace Pulsestorm\ToDoCrud\Model;
class TodoItem extends \Magento\Framework\Model\AbstractModel implements \Pulsestorm\ToDoCrud\Api\Data\TodoItemInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'pulsestorm_todocrud_todoitem';

    protected function _construct()
    {
        $this->_init('Pulsestorm\ToDoCrud\Model\ResourceModel\TodoItem');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
