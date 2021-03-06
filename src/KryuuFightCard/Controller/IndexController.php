<?php
namespace KryuuFightCard\Controller;

/**
 * @encoding UTF-8
 * @note *
 * @todo *
 * @package PackageName
 * @author Anders Blenstrup-Pedersen - KatsuoRyuu <anders-github@drake-development.org>
 * @license *
 * The Ryuu Technology License
 *
 * Copyright 2014 Ryuu Technology by 
 * KatsuoRyuu <anders-github@drake-development.org>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * Ryuu Technology shall be visible and readable to anyone using the software 
 * and shall be written in one of the following ways: 竜技術, Ryuu Technology 
 * or by using the company logo.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *

 * @version 20140506 
 * @link https://github.com/KatsuoRyuu/
 */

use Zend\View\Model\ViewModel;
use KryuuFightCard\Controller\ConstantsController;

class IndexController extends ConstantsController
{
	
	protected $ContactTable;
	
    public function indexAction()
    {
        $primaryFights      = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 0),array('sort'=>'ASC'));
        $secondaryFights    = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 1),array('sort'=>'ASC'));
        $tertiaryFights     = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 2),array('sort'=>'ASC'));
        $quaternaryFights   = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 3),array('sort'=>'ASC'));
        $quinaryFights      = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 4),array('sort'=>'ASC'));
        
        $championship = $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->findAll();

        return array(
            'primaryFights'     => $primaryFights,
            'secondaryFights'   => $secondaryFights,
            'tertiaryFights'    => $tertiaryFights,
            'quaternaryFights'  => $quaternaryFights,
            'quinaryFights'     => $quinaryFights,
            
            'championships'     => $championship,
            'administration'    => self::ADMINISTRATION,
            
            'addChampionship'   => self::ADD_CHAMPIONSHIP,
            'editChampionship'  => self::EDIT_CHAMPIONSHIP,
            'deleteChampionship'=> self::DELETE_CHAMPIONSHIP,
            
            'addFighter'        => self::ADD_FIGHTER,
            'editFighter'       => self::EDIT_FIGHTER,
            'deleteFighter'     => self::DELETE_FIGHTER,
        );
    }
    
    public function primaryIndexAction()
    {
        $primaryFights      = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 0),array('sort'=>'ASC'));
        $secondaryFights    = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 1),array('sort'=>'ASC'));
        $tertiaryFights     = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 2),array('sort'=>'ASC'));
        $quaternaryFights   = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 3),array('sort'=>'ASC'));
        $quinaryFights      = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 4),array('sort'=>'ASC'));
        
        $championship = $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->findAll();

        return array(
            'primaryFights'     => $primaryFights,
            'secondaryFights'   => $secondaryFights,
            'tertiaryFights'    => $tertiaryFights,
            'quaternaryFights'  => $quaternaryFights,
            'quinaryFights'     => $quinaryFights,
            
            'championships'     => $championship,
            'administration'    => self::ADMINISTRATION,
            
            'addChampionship'   => self::ADD_CHAMPIONSHIP,
            'editChampionship'  => self::EDIT_CHAMPIONSHIP,
            'deleteChampionship'=> self::DELETE_CHAMPIONSHIP,
            
            'addFighter'        => self::ADD_FIGHTER,
            'editFighter'       => self::EDIT_FIGHTER,
            'deleteFighter'     => self::DELETE_FIGHTER,
        );
    }
    
    public function secondaryIndexAction()
    {
        $primaryFights      = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 0),array('sort'=>'ASC'));
        $secondaryFights    = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 1),array('sort'=>'ASC'));
        $tertiaryFights     = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 2),array('sort'=>'ASC'));
        $quaternaryFights   = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 3),array('sort'=>'ASC'));
        $quinaryFights      = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 4),array('sort'=>'ASC'));
        
        $championship = $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->findAll();

        return array(
            'primaryFights'     => $primaryFights,
            'secondaryFights'   => $secondaryFights,
            'tertiaryFights'    => $tertiaryFights,
            'quaternaryFights'  => $quaternaryFights,
            'quinaryFights'     => $quinaryFights,
            
            'championships'     => $championship,
            'administration'    => self::ADMINISTRATION,
            
            'addChampionship'   => self::ADD_CHAMPIONSHIP,
            'editChampionship'  => self::EDIT_CHAMPIONSHIP,
            'deleteChampionship'=> self::DELETE_CHAMPIONSHIP,
            
            'addFighter'        => self::ADD_FIGHTER,
            'editFighter'       => self::EDIT_FIGHTER,
            'deleteFighter'     => self::DELETE_FIGHTER,
        );
    }
    
    public function tertiaryIndexAction()
    {
        $primaryFights      = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 0),array('sort'=>'ASC'));
        $secondaryFights    = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 1),array('sort'=>'ASC'));
        $tertiaryFights     = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 2),array('sort'=>'ASC'));
        $quaternaryFights   = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 3),array('sort'=>'ASC'));
        $quinaryFights      = $this->getEntityManager()->getRepository(self::FIGHT)->findBy(array('priority' => 4),array('sort'=>'ASC'));
        
        $championship = $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->findAll();

        return array(
            'primaryFights'     => $primaryFights,
            'secondaryFights'   => $secondaryFights,
            'tertiaryFights'    => $tertiaryFights,
            'quaternaryFights'  => $quaternaryFights,
            'quinaryFights'     => $quinaryFights,
            
            'championships'     => $championship,
            'administration'    => self::ADMINISTRATION,
            
            'addChampionship'   => self::ADD_CHAMPIONSHIP,
            'editChampionship'  => self::EDIT_CHAMPIONSHIP,
            'deleteChampionship'=> self::DELETE_CHAMPIONSHIP,
            
            'addFighter'        => self::ADD_FIGHTER,
            'editFighter'       => self::EDIT_FIGHTER,
            'deleteFighter'     => self::DELETE_FIGHTER,
        );
    }
    
}