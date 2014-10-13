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

 * @version 20140527 
 * @link https://github.com/KatsuoRyuu/
 */

use KryuuFightCard\Controller\ConstantsController;

class AdministrationController extends ConstantsController {
    
    public function indexAction(){
        
        $this->layout('thaifights/layout/single');
        
        $fighter = $this->getEntityManager()->getRepository(self::FIGHTER)->findBy(array(), array('firstname' => 'ASC'));
        
        $championship = $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->findAll();
        
        $fights = $this->getEntityManager()->getRepository(self::FIGHT)->findAll();

        return array(
            'fighters'                  =>  $fighter,
            'championships'             =>  $championship,
            'fights'                    =>  $fights,
            'administration'            =>  self::ADMINISTRATION,
            
            'addChampionship'           =>  self::ADD_CHAMPIONSHIP,
            'editChampionship'          =>  self::EDIT_CHAMPIONSHIP,
            'deleteChampionship'        =>  self::DELETE_CHAMPIONSHIP,
            
            'addFighter'                =>  self::ADD_FIGHTER,
            'editFighter'               =>  self::EDIT_FIGHTER,
            'deleteFighter'             =>  self::DELETE_FIGHTER,
            
            'disconnect_championship'   =>  self::DISCONNECT_CHAMPIONSHIP,
            'connect_championship'      =>  self::CONNECT_CHAMPIONSHIP,
            
            'addFight'                  =>  self::ADD_FIGHT,
            'editFight'                 =>  self::EDIT_FIGHT,
            'deleteFight'               =>  self::DELETE_FIGHT,
        );
    }
}
