<?php

namespace FightCard\Entity;

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

 * @version 20140526 
 * @link https://github.com/KatsuoRyuu/
 */
use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection,
    Zend\Form\Annotation,
    FightCard\Entity\Championship;

/**
 * @Annotation\Name("fighter")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @ORM\Entity
 * @ORM\Table(name="fightcard_fighter")
 */
class Fighter {
    
    /**
     * @Annotation\Exclude()
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer 
     */
    private $id;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Flags({"priority": 600})
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StringTrim"})
     * @ Annotation\Validator({"name":"StringLength"})
     * @Annotation\Options({"label":"first name:"})
     * @Annotation\Attributes({"required": true,"placeholder": "firstname ..."})
     * 
     * @ORM\Column(type="string")
     * @var String
     */
    private $firstname;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Flags({"priority": 600})
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StringTrim"})
     * @ Annotation\Validator({"name":"StringLength"})
     * @Annotation\Options({"label":"Last name:"})
     * @Annotation\Attributes({"required": true,"placeholder": "lastname ...."})
     * 
     * @ORM\Column(type="string")
     * @var String
     */    
    private $lastname;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Flags({"priority": 600})
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StringTrim"})
     * @ Annotation\Validator({"name":"StringLength"})
     * @Annotation\Options({"label":"Country:"})
     * @Annotation\Attributes({"required": true,"placeholder": "Country"})
     * 
     * @ORM\Column(type="string")
     * @var String
     */    
    private $country;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Flags({"priority": 600})
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StringTrim"})
     * @ Annotation\Validator({"name":"StringLength"})
     * @Annotation\Options({"label":"Gym:"})
     * @Annotation\Attributes({"required": true,"placeholder": "Gym ..."})
     * 
     * @ORM\Column(type="string")
     * @var String
     */    
    private $gym;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Flags({"priority": 600})
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StringTrim"})
     * @ Annotation\Validator({"name":"StringLength"})
     * @Annotation\Options({"label":"Wins:"})
     * @Annotation\Attributes({"required": true,"placeholder": "0"})
     * 
     * @ORM\Column(type="integer")
     * @var String
     */    
    private $wins;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Flags({"priority": 600})
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StringTrim"})
     * @ Annotation\Validator({"name":"StringLength"})
     * @Annotation\Options({"label":"Loss:"})
     * @Annotation\Attributes({"required": true,"placeholder": "0"})
     * 
     * @ORM\Column(type="integer")
     * @var String
     */    
    private $loss;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Flags({"priority": 600})
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StringTrim"})
     * @ Annotation\Validator({"name":"StringLength"})
     * @Annotation\Options({"label":"Draw:"})
     * @Annotation\Attributes({"required": true,"placeholder": "0"})
     * 
     * @ORM\Column(type="integer")
     * @var String
     */    
    private $draw;
    
    /**
     * @Annotation\Exclude()
     * 
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="FightCard\Entity\Championship")
     * @ORM\JoinTable(name="fightcard_fighter_championship_linker",
     *      joinColumns={@ORM\JoinColumn(name="fighter_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="championship_id", referencedColumnName="id")}
     * )
     */   
    private $championships;
    
    public function __construct() {
        $this->championships = new ArrayCollection();
    }
    
    public function __get($key){
        return $this->$key;
    }
    
    public function __set($value, $key){
        $this->$key = $value;
        return $this;
    }
    
    public function __add($value, $key){
        if ($this->$key == ArrayCollection){
            $this->$key->add($value);
        }
        return $this;
    }
}
