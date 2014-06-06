<?php

namespace KryuuFightCard;

return array(    
    'FightCard' => array(
        'config' => array(
            'fileupload' => true,
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'FightCard\Controller\Index'            => 'FightCard\Controller\IndexController',
            'FightCard\Controller\Administration'   => 'FightCard\Controller\AdministrationController',
            'FightCard\Controller\Championship'     => 'FightCard\Controller\ChampionshipController',
            'FightCard\Controller\Fighter'          => 'FightCard\Controller\FighterController',
            'FightCard\Controller\Fight'          => 'FightCard\Controller\FightController',
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
                    'administration' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/administration',
                            'defaults' => array(
                                'controller' => 'FightCard\Controller\Administration',
                                'action' => 'index',
                            ),
                        ),
                    ),
                    'fighter' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/fighter',
                            'defaults' => array(
                                'controller' => 'FightCard\Controller\Fighter',
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
                                        'controller' => 'FightCard\Controller\Fighter',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route'    => '/edit[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'FightCard\Controller\Fighter',
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route'    => '/delete[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'FightCard\Controller\Fighter',
                                        'action' => 'delete',
                                    ),
                                ),
                            ),
                            'disconnect-championship' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route'    => '/disconnect[/:fid][/:cid]',
                                    'constraints' => array(
                                        'fid'     => '[0-9]+',
                                        'cid'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'FightCard\Controller\Fighter',
                                        'action' => 'disconnectChampionship',
                                    ),
                                ),
                            ),
                            'connect-championship' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route'    => '/connect[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'FightCard\Controller\Fighter',
                                        'action' => 'connectChampionship',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'championship' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/championship',
                            'defaults' => array(
                                'controller' => 'FightCard\Controller\Championship',
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
                                        'controller' => 'FightCard\Controller\Championship',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route'    => '/edit[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'FightCard\Controller\Championship',
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route'    => '/delete[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'FightCard\Controller\Championship',
                                        'action' => 'delete',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'fight' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/fight',
                            'defaults' => array(
                                'controller' => 'FightCard\Controller\Fight',
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
                                        'controller' => 'FightCard\Controller\Fight',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route'    => '/edit[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'FightCard\Controller\Fight',
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route'    => '/delete[/:id]',
                                    'constraints' => array(
                                        'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'FightCard\Controller\Fight',
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