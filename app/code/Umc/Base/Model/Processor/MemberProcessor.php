<?php
/**
 * Umc_Base extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Umc
 * @package   Umc_Base
 * @copyright 2015 Marius Strajeru
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @author    Marius Strajeru <ultimate.module.creator@gmail.com>
 */
namespace Umc\Base\Model\Processor;

use Umc\Base\Model\Core\AbstractModel;
use Umc\Base\Model\Provider\Processor\ProviderInterface;
use Umc\Base\Model\Config\ClassConfig;
use Umc\Base\Model\Parser\Member as MemberParser;
use Umc\Base\Model\Processor\AbstractProcessor;

class MemberProcessor extends AbstractProcessor implements ProcessorInterface
{
    /**
     * class config reference
     *
     * @var ClassConfig
     */
    protected $classConfig;

    /**
     * member parser
     *
     * @var \Umc\Base\Model\Parser\Member
     */
    protected $memberParser;

    /**
     * @param ClassConfig $classConfig
     * @param MemberParser $memberParser
     * @param ProviderInterface $modelProvider
     */
    public function __construct(
        ClassConfig $classConfig,
        MemberParser $memberParser,
        ProviderInterface $modelProvider
    )
    {
        $this->classConfig   = $classConfig;
        $this->memberParser  = $memberParser;
        parent::__construct($modelProvider);
    }

    /**
     * process member
     *
     * @param $member
     * @param string $rawContent
     * @return array|bool
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function process($member, $rawContent = '')
    {
        $members = [];
        foreach ($this->getModelsToProcess() as $model) {
            if ($model->validateDepend($member)) {
                $this->memberParser->setModel($model);
                $parsedMember = $this->memberParser->parse($member);
                $members[$parsedMember['id']] = $parsedMember;
            }
        }
        if (count($members)) {
            return $members;
        }
        return false;
    }

    /**
     * get models to process
     *
     * @return AbstractModel[]
     */
    protected function getModelsToProcess()
    {
        return $this->modelProvider->setMainModel($this->model)->getModels();
    }
}