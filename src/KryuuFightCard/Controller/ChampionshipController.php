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

use KryuuFightCard\Controller\ConstantsController,
    KryuuFightCard\Entity\Championship,
    Zend\Form\Annotation\AnnotationBuilder;

class ChampionshipController extends ConstantsController{
    
    public function indexAction(){
        
    }
    
    public function addAction(){
        $this->layout('thaifights/layout/single');
        return $this->editAction();
    }
    
    public function editAction(){
        $this->layout('thaifights/layout/single');
        $championship = new Championship();
        
        if ($this->params('id') > 0){
            $championship = $this->getEntityManager()->getRepository('FightCard\Entity\Championship')->find($this->params('id'));
        }
        
        $builder = new AnnotationBuilder();
        $form    = $builder->createForm($championship);
        $form->bind($championship);
        $form->setData($championship->getArrayCopy());
        
        $request = $this->getRequest();
        
        if ($request->isPost()){
            
            $form->bind($championship);
            $form->setData($request->getPost());
                       
            if($form->isValid()){
                $this->getEntityManager()->persist($championship);
                $this->getEntityManager()->flush();

                $this->flashMessenger()->addMessage('Championship added');

                return $this->redirect()->toRoute(self::ADMINISTRATION);
            }
        }
        
        return array(
            'form'          => $form,
            'championship'  => $championship,
            'addUrl'        => self::ADD_CHAMPIONSHIP,  
            'editUrl'       => self::EDIT_CHAMPIONSHIP,  
        );
        
    }
    
    public function deleteAction(){
        $this->layout('thaifights/layout/single');
        
        if($this->params('id')){
            $championship = $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->find($this->params('id'));
            if($championship){
                $name   = $championship->__get('name');
                $id     = $championship->__get('id');
                $this->getEntityManager()->remove($championship);
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addMessage("Championship $name with id $id has been deleted");
                
                return $this->redirect()->toRoute(self::ADMINISTRATION);               
            }
        }
         
        $this->flashMessenger()->addMessage("failed to delete the Championship");
        
        return $this->redirect()->toRoute(self::ADMINISTRATION);  
    }
}
