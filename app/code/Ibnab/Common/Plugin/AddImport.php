<?php

namespace Ibnab\Common\Plugin;
class AddImport
{
    public function aroundGetMainButtonsHtml($grid,$html)
    {
      return $html().$grid->getChildHtml('grid.import');
    }

}
