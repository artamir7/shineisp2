<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletoncms for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
		'bjyauthorize' => array(
				'guards' => array(
					'BjyAuthorize\Guard\Route' => array(
							
		                // Generic route guards
		                array('route' => 'cms', 'roles' => array('guest')),
		                array('route' => 'cms/page', 'roles' => array('guest')),
							
						// Custom Module
						array('route' => 'zfcadmin/cmspages', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmspages/default', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmsblocks', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmsblocks/default', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmscategory', 'roles' => array('admin')),
						array('route' => 'zfcadmin/cmscategory/default', 'roles' => array('admin')),
						array('route' => 'zfcadmin/languages', 'roles' => array('admin')),
						array('route' => 'zfcadmin/languages/default', 'roles' => array('admin')),
					),
			  ),
		),
		'navigation' => array(
				'default' => array(
						'cms' => array(
								'label' => _('News'),
								'route' => 'cms',
						),
				),
				'admin' => array(
						'cmspages' => array(
								'label' => _('CMS'),
								'resource' => 'menu',
								'route' => 'zfcadmin/cmspages',
								'privilege' => 'list',
								'pages' => array (
										array (
												'label' => 'Pages',
												'route' => 'zfcadmin/cmspages',
												'icon' => 'fa fa-list'
										),
										array (
												'label' => 'Blocks',
												'route' => 'zfcadmin/cmsblocks',
												'icon' => 'fa fa-list'
										),
										array (
												'label' => 'Page Categories',
												'route' => 'zfcadmin/cmscategory',
												'icon' => 'fa fa-list'
										),
								),
						),
				),
		),
    'router' => array(
        'routes' => array(
        		'zfcadmin' => array(
        				'child_routes' => array(
        						'cmspages' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/cmspages',
        										'defaults' => array(
        												'controller' => 'CmsAdmin\Controller\Page',
        												'action'     => 'index',
        										),
        								),
        								'may_terminate' => true,
        								'child_routes' => array (
        										'default' => array (
        												'type' => 'Segment',
        												'options' => array (
        														'route' => '/[:action[/:id]]',
        														'constraints' => array (
        																'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        																'id' => '[0-9]*'
        														),
        														'defaults' => array ()
        												)
        										)
        								),
        						),
        						'cmscategory' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/cmscategory',
        										'defaults' => array(
        												'controller' => 'CmsAdmin\Controller\PageCategory',
        												'action'     => 'index',
        										),
        								),
        								'may_terminate' => true,
        								'child_routes' => array (
        										'default' => array (
        												'type' => 'Segment',
        												'options' => array (
        														'route' => '/[:action[/:id]]',
        														'constraints' => array (
        																'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        																'id' => '[0-9]*'
        														),
        														'defaults' => array ()
        												)
        										)
        								),
        						),
        						'cmsblocks' => array(
        								'type' => 'literal',
        								'options' => array(
        										'route' => '/cmsblocks',
        										'defaults' => array(
        												'controller' => 'CmsAdmin\Controller\Block',
        												'action'     => 'index',
        										),
        								),
        								'may_terminate' => true,
        								'child_routes' => array (
        										'default' => array (
        												'type' => 'Segment',
        												'options' => array (
        														'route' => '/[:action[/:id]]',
        														'constraints' => array (
        																'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        																'id' => '[0-9]*'
        														),
        														'defaults' => array ()
        												)
        										)
        								),
        						),
        				),
        		),
            'cms' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/cms',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cms\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'page' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:page].html',
                            'constraints' => array(
                            	'page'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            		'action'        => 'page',
                            ),
                        ),
                    ),
                    
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
        ),
        'factories' => array(
        		'Cms\Controller\Index' => 'Cms\Factory\PageControllerFactory',
        		'CmsAdmin\Controller\Page' => 'CmsAdmin\Factory\PageControllerFactory',
        		'CmsAdmin\Controller\Block' => 'CmsAdmin\Factory\BlockControllerFactory',
        		'CmsAdmin\Controller\PageCategory' => 'CmsAdmin\Factory\PageCategoryControllerFactory',
        )
    ),
    'view_helpers' => array (
    		'invokables' => array (
    				'blocks' => 'Cms\View\Helper\Blocks',
		    		'extract' => 'Cms\View\Helper\Extract',
    				'tags' => 'Cms\View\Helper\Tags',
    		)
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);