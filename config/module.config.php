<?php

namespace FightCard;

return array(
    'controllers' => array(
        'invokables' => array(
            'FightCard\Controller\Index' => 'FightCard\Controller\IndexController',
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