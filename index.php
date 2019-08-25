<?php
error_reporting( E_ALL & ~E_NOTICE );
include( 'Container/Container.class.php' );
include( 'Controller/IndexController.class.php' );
include( 'Service/ModelService.class.php' );
include( 'Model/Model.class.php' );
include( 'dump.php' );

use Container\Container;
use Controller\IndexController;

use Service\ModelService;
use Model\Model;

$container = new Container();
//第二阶段测试

$ModelService = new ModelService();
$Model = new Model();

$IndexController = new IndexController( $Model );
$IndexController = new IndexController( $ModelService );





//第一阶段测试

// $container = new Container();
// $container->bind( 'Controller\IndexController' );
// $container->bind( 'Aaa\aaaController' );
// $container->bind( 'Aaa\ModelInterface' );
// $container->bind( 'Aaa\ModelInterfaceaaa', 'aaa' );
// $container->bind( 'Interface\ModelInterface', array('Controller\IndexController'));
// $container->bind( 'Interfaces\ModelInterface', array('Service\Model'));
// $container->bind( 'Interfaces\ModelInterface', array('Service\aaaa' ));
// $container->bind( 'Interfaces\ModelInterface', array('Controller\IndexController', 'Service\ModelService' ));
// $container->bind( 'Interfaces\ModelInterface', array('Controller\IndexController', 'asdfsadf' ));
// $container->bind( 'aaaa\ModelInteccccface', array('gggg\fffff'));
// $container->bind( 'aaaa\ModelInteccccface', array('dasdfas\eeee'));
// $container->bind( 'aaaa\Mcccface', array('dasdfas\eeee'));
// $container->bind( 'IndexController', 'Controller\IndexController' );
// $container->bind( 'ModelInterface', array( 'ModelService', 'Controller\IndexController'));
// $container->bind( 'ModelInterface', array( 'IndexController', 'Service\ModelService' ));
// $container->bind( 'ModelInterface', 'IndexController' );

// $container->bind( 'ModelInterface', 'Service\ModelService' );
// $container->bind( 'ModelInterface', 'IndexController', 'Model\Model' );
//反射接口要放三个参数
//第一个参数为接口名,第二个参数为实现接口的类名,第三个参数为普通参数(本类需要用的参数,如果没有不传也可以)
//格式如下：
//public function __construct( Interface $Interface, $className, $params )
// $container->getBind();

// $IndexController = $container->make( 'ModelInterface', 'abs' );
// $IndexController = $container->make( 'ModelInterface', 'abs' );
// $IndexController->connection();



