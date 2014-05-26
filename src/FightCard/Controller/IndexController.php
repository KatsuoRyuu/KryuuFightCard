<?php
namespace FightCard\Controller;

use Zend\View\Model\ViewModel;
use FightCard\Controller\EntityUsingController;

class IndexController extends EntityUsingController
{
	
	protected $ContactTable;
	
    public function indexAction()
    {
        print_r($this->getConfiguration('mailTransport',true));
        return new ViewModel();
    }
    
}
