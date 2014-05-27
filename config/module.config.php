<?php

namespace FightCard;

return array(
    'controllers' => array(
        'invokables' => array(
            'FightCard\Controller\Index'            => 'FightCard\Controller\IndexController',
            'FightCard\Controller\Administration'   => 'FightCard\Controller\AdministrationController',
            'FightCard\Controller\Championship'     => 'FightCard\Controller\ChampionshipController',
            'FightCard\Controller\Fighter'          => 'FightCard\Controller\FighterController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'fightcard' => array(
                'type'    => 'literal',
                'options' => array(
                    'route' => '/fightcard',
                    'defaults' => array(
                        'controller'    => 'FightCard\Controller\Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'fighter' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/fighter',
                            'defaults' => array(
                                'controller' => 'Contact\Controller\Index',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route'    => '/add',
                                    'defaults' => array(
                                        'controller' => 'Contact\Controller\Fighter',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route'    => '/edit[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Contact\Controller\Fighter',
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route'    => '/delete[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Contact\Controller\Fighter',
                                        'action' => 'delete',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'doctrine'=> array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'fightcard' => __DIR__ . '/../view',
        ),
    ),
);