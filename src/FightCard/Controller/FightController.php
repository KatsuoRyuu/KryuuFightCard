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

 * @version 20140604 
 * @link https://github.com/KatsuoRyuu/
 */

use FightCard\Entity\Fighter,
    FightCard\Entity\Championship,
    FightCard\Entity\Fight,
    Zend\Form\Annotation\AnnotationBuilder,
    Zend\View\Model\ViewModel;


class FightController extends ConstantsController {
    
    public function addAction(){
        return $this->editAction();
    }
    
    public function editAction(){

        $fight = new Fight();

        if ($this->params('id') > 0){
            $fight = $this->getEntityManager()->getRepository(self::FIGHT)->find($this->params('id'));
        }


        $builder = new AnnotationBuilder();
        $form    = $builder->createForm($fight);
        $form->add(array(
            'type'=>'select',
            'priority'=>300,
            'name'=>'fighter1',
            'options'=>array(
                'label'=>'Select Fighter',
                'options'=>$this->getFightersNameList($this->getFighters()),
            ),
        ));
        $form->add(array(
            'type'=>'select',
            'priority'=>300,
            'name'=>'fighter2',
            'options'=>array(
                'label'=>'Select Fighter',
                'options'=>$this->getFightersNameList($this->getFighters()),
            ),
        ));
                
        if ($this->params('id') > 0){
            $form->get('fighter1')->setAttributes(array('value'=>$fight->__get('fighter')->first()->__get('id'),'selected'=>true));
            $form->get('fighter2')->setAttributes(array('value'=>$fight->__get('fighter')->last()->__get('id'),'selected'=>true));

        }
        $request = $this->getRequest();

        if ($request->isPost()){
            
            $form->bind($fight);
            $form->setData($request->getPost());

            if ($form->isValid()){

                $fighter = $this->getEntityManager()->getRepository(self::FIGHTER)->findOneBy(array('id'=>$request->getPost()->fighter1));
                $fight->__add($fighter,'fighter');

                $fighter = $this->getEntityManager()->getRepository(self::FIGHTER)->findOneBy(array('id'=>$request->getPost()->fighter2));
                $fight->__add($fighter,'fighter');

                $this->getEntityManager()->persist($fight);
                $this->getEntityManager()->flush();

                $this->flashMessenger()->addMessage('New fight has been created.');
                return $this->redirect()->toRoute(self::ADMINISTRATION);

            }
        }
       
        return new ViewModel(array(
            'fight'=> $fight,
            'form' => $form, 
        ));
    }
    
    public function deleteAction(){
                
        if($this->params('id')){
            $fight = $this->getEntityManager()->getRepository(self::FIGHT)->find($this->params('id'));
            if($fight){
                
                $fighter[] = $fight->__get('fighter')->first()->__get('firstname').' '. $fight->__get('fighter')->first()->__get('lastname');
                $fighter[] = $fight->__get('fighter')->last()->__get('firstname').' '. $fight->__get('fighter')->last()->__get('lastname');
                
                $id     = $fight->__get('id');
                $this->getEntityManager()->remove($fight);
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addMessage("Fight between $fighter[0] and $fighter[1] with id $id has been deleted");
                
                return $this->redirect()->toRoute(self::ADMINISTRATION);               
            }
        }
         
        $this->flashMessenger()->addMessage("failed to delete the fighter");
        
        return $this->redirect()->toRoute(self::ADMINISTRATION);  
    }
    
    private function getFighters(){
        return $this->getEntityManager()->getRepository(self::FIGHTER)->findAll();
    }
    
    private function getFightersNameList($fighters){
        $fightersArray=array();
        foreach($fighters as $fighter){
            $fightersArray[$fighter->__get('id')] = $fighter->__get('firstname').' '.$fighter->__get('lastname'); 
            
        }
        return $fightersArray;
    }
    
}
