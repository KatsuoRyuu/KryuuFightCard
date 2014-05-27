<?php

namespace FightCard\Controller;

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

use FightCard\Controller\ConstantsController,
    FightCard\Entity\Fighter,
    Zend\Form\Annotation\AnnotationBuilder;


class FighterController extends ConstantsController {
    
    
    public function indexAction() {
        
        
    }
    
    public function addAction(){
        return $this->editAction();
    }
    
    public function editAction(){
        
        $fighter = new Fighter();
        
        if ($this->params('id')){
            $fighter = $this->getEntityManager()->getRepository(self::FIGHTER)->findBy(array('id'=>$this->params('id')));
        }
        
        $builder = new AnnotationBuilder();
        $form    = $builder->createForm($fighter);
        $form->bind($fighter);
        
        $request = $this->getRequest();
        
        if ($request->isPost()){
            $form->bind($fighter);
            $form->setData($request->getPost());
            
            if($form->isValid()){
                $this->getEntityManager()->persist($fighter);
                $this->getEntityManager()->flush();
                
                
                $this->flashMessenger()->addMessage('Fighter added');

                return $this->redirect()->toRoute(self::ADMINISTRATION);
            }
        } 
        return array(
            'form'      => $form,
            'addUrl'    => self::ADD_FIGHTER,  
            'editUrl'   => self::EDIT_FIGHTER,  
            );
    }
    
    public function deleteAction(){
        
        if($this->params('id')){
            $fighter = $this->getEntityManager()->getRepository(self::FIGHTER)->find($this->params('id'));
            if($fighter){
                $name   = $fighter->__get('name');
                $id     = $fighter->__get('id');
                $this->getEntityManager()->remove($fighter);
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addMessage("Fighter $name with id $id has been deleted");
                
                return $this->redirect()->toRoute(self::ADMINISTRATION);               
            }
        }
         
        $this->flashMessenger()->addMessage("failed to delete the fighter");
        
        return $this->redirect()->toRoute(self::ADMINISTRATION);  
    }
}

