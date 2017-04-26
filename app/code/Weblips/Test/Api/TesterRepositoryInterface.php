<?php
namespace Weblips\Test\Api;

use Weblips\Test\Api\Data\TesterInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface TesterRepositoryInterface 
{
    public function save(TesterInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(TesterInterface $page);

    public function deleteById($id);
}
