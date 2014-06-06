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
    KryuuFightCard\Entity\Fighter,
    Zend\Form\Annotation\AnnotationBuilder,
    Zend\Form\Form;


class FighterController extends ConstantsController {
    
    
    public function indexAction() {
        
        
    }
    
    public function addAction(){
        return $this->editAction();
    }
    
    public function editAction(){
                
        $fighter = new Fighter();
        $isFile = false;
        
        if ($this->params('id') > 0){
            $fighter = $this->getEntityManager()->getRepository(self::FIGHTER)->find($this->params('id'));
        }
        
        $builder = new AnnotationBuilder();
        $form    = $builder->createForm($fighter);
        
        $form->bind($fighter);
        $form->setData($fighter->getArrayCopy());
         
        $request = $this->getRequest();            
        
        $form->add(array( 
                'name' => 'file', 
                'type' => 'file', 
                'options' => array( 
                    'label' => 'File Upload:', 
                ), 
            ));
        
        if ( $request->getFiles()['file']['tmp_name'] != "" && $this->getConfiguration('fileupload') ){
            
            $requestData = array_merge_recursive((array) $request->getPost(),(array) $request->getFiles());
            $isFile  = true;

        } else {
            $requestData = (array) $request->getPost();

        }
        
        if ($request->isPost()){
            $form->bind($fighter);
            $form->setData($request->getPost());
            
            if($form->isValid()){
                
                if ($isFile) {
                    $fighter->__set($this->storeFile($request->getFiles()), 'image');
                    
                }
                
                $this->getEntityManager()->persist($fighter);
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addMessage('Fighter added');

                return $this->redirect()->toRoute(self::ADMINISTRATION);
            }
        } 
        return array(
            'form'      => $form,
            'fighter'   => $fighter,
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
    
    public function connectChampionshipAction(){
                
        $fighter = new Fighter();
        
        if ($this->params('id') > 0){
            $fighter = $this->getEntityManager()->getRepository(self::FIGHTER)->find($this->params('id'));
        }
        
        $form = new Form('connect-championship');
        
        $form->add(array( 
            'name' => 'championship', 
            'type' => 'select', 
            'options' => array( 
                'label' => 'File Upload:',
                'options' => $this->getChampionshipsArray(), 
            ), 
        ));
        
        $request = $this->getRequest();
        
        if ($request->isPost()){
            $form->bind($fighter);
            $form->setData($request->getPost());
            
            if($form->isValid()){
                print_r( $request->getPost() );
                $championship = $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->find($request->getPost()->championship);
                
                $fighter->__add($championship,'championships');
                
                $this->getEntityManager()->persist($fighter);
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addMessage('Fighter added');

                return $this->redirect()->toRoute(self::ADMINISTRATION);
            }
        } 
        return array(
            'form'                      => $form,
            'fighter'                   => $fighter,
            'addUrl'                    => self::ADD_FIGHTER,  
            'editUrl'                   => self::EDIT_FIGHTER,
            'disconnect_championship'   => self::DISCONNECT_CHAMPIONSHIP,
            'connect_championship'      => self::CONNECT_CHAMPIONSHIP
        );    
    }
    
    public function disconnectChampionshipAction(){
        if($this->params('fid') > 0 && $this->params('cid') > 0){
            $fighter        = $this->getEntityManager()->getRepository(self::FIGHTER)->find($this->params('fid'));
            $championship   = $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->find($this->params('cid'));
            if($fighter && $championship){
                $name   = $fighter->__get('name');
                $id     = $fighter->__get('id');
                
                $fighter->__get('championships')->removeElement($championship);
                
                $this->getEntityManager()->persist($fighter);
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addMessage("Fighter $name with id $id has been deleted");
                
                return $this->redirect()->toRoute(self::ADMINISTRATION);               
            }
        }
         
        $this->flashMessenger()->addMessage("failed to delete the fighter");
        
        return $this->redirect()->toRoute(self::ADMINISTRATION); 
    }
    
    private function getChampionshipsArray(){
        $array = array();
        $championships = $this->getChampionships();
        
        foreach($championships as $championship){
            $array[$championship->__get('id')] = $championship->__get('name');
        }
        
        return $array;
    }
    
    private function getChampionships(){
        return $this->getEntityManager()->getRepository(self::CHAMPIONSHIP)->findAll();
    }
    
    private function storeFile($file){

        //if (!$this->getConfiguration('fileupload')){
        //    return null;
        //}
        
        $fileRepo = $this->getServiceLocator()->get('FileRepository');
        $file = $fileRepo->save($file['file']['tmp_name'],$file['file']['name']);
        return $file;
    }
}

