<?php
namespace Weblips\Test\Model\ResourceModel\Tester;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Weblips\Test\Model\Tester','Weblips\Test\Model\ResourceModel\Tester');
    }
}
