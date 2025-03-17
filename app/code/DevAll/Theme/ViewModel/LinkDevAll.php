<?php

namespace DevAll\Theme\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class LinkDevAll implements ArgumentInterface
{

    public function getLink()
    {
        return 'https://developers-alliance.com/';
    }

}
