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

use KryuuFightCard\Controller\EntityUsingController;

class ConstantsController extends EntityUsingController {
        
    const ADMINISTRATION            = 'fightcard/administration';
    
    const ADD_CHAMPIONSHIP          = 'fightcard/championship/add';
    const EDIT_CHAMPIONSHIP         = 'fightcard/championship/edit';
    const DELETE_CHAMPIONSHIP       = 'fightcard/championship/delete';
    
    const ADD_FIGHTER               = 'fightcard/fighter/add';
    const EDIT_FIGHTER              = 'fightcard/fighter/edit';
    const DELETE_FIGHTER            = 'fightcard/fighter/delete';
    
    const CONNECT_CHAMPIONSHIP      = 'fightcard/fighter/connect-championship';
    const DISCONNECT_CHAMPIONSHIP   = 'fightcard/fighter/disconnect-championship';
    
    const ADD_FIGHT                 = 'fightcard/fight/add';
    const EDIT_FIGHT                = 'fightcard/fight/edit';
    const DELETE_FIGHT              = 'fightcard/fight/delete';

    const FIGHTER                   = 'FightCard\Entity\Fighter';
    const CHAMPIONSHIP              = 'FightCard\Entity\Championship';
    const FIGHT                     = 'FightCard\Entity\Fight';
}
