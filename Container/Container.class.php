<?php
namespace Container;

use ReflectionClass;
use InvalidArgumentException;
use BadMethodCallException;

class Container
{

	public $bindings = array();

	public function bind( $abstract,  $concrete = null, $shared = false ) {
		
		if ( is_null( $concrete ))
			$concrete = $abstract;

		if ( false == is_array( $concrete )) {
			$this->bindings[$abstract] = $concrete;
		} else {
			if ( empty( $concrete[1] )) {
				$this->bindings[$abstract][$concrete[0]] = null;
			} else {
				$this->bindings[$abstract][$concrete[1]] = $concrete[0];
			}
		}
		
	}

	public function make( $abstract, $concrete = null ) {

		if ( is_null( $concrete ))
			list( $concrete, $abstract ) = array( $abstract, $concrete );

		$concrete = $this->searchConcrete( $abstract, $concrete );
		echo $concrete;

		// new 

		return $this->getInstance( $abstract, $concrete );
	}

	//搜索类的位置
	public function searchConcrete( $abstract, $concrete = null ) {

		//匹配绑定的类名
		$concrete = $this->matchBinds( $abstract, $concrete );
			
		//匹配别名
		$alias = $this->matchAlias( $abstract, $concrete );
		if ( $alias ) {
			$abstract = $alias[0];
			$concrete = $alias[1];
		}
		// dump($alias);
		//
		if ( false == empty( $abstract ) && false == interface_exists( $abstract ) )
			die( 'searchConcrete: abstract '.$abstract.' not found' );

		//判断类是否存在
		if ( false == class_exists( $concrete ))
			die( 'searchConcrete: concrete '.$concrete.' not found' );

		return $concrete;
	}

	//匹配别名
	public function matchAlias( $abstract, $concrete = null ) {

		$alias = $this->bindAlias();

		if ( false == is_null( $concrete )) {
			//匹配接口别名
			if ( $alias[$abstract] )
				$abstract = $alias[$abstract];
		} else {
			$concrete = $abstract;
			unset( $abstract );
		}

		//匹配类别名
		if ( $alias[$concrete] )
			$concrete = $alias[$concrete];

		return array( $abstract, $concrete );
	}

	//匹配接口与类名是否绑定
	public function matchBinds( $abstract, $concrete = null ) {

		//查找类是否有绑定名称
		if ( is_null( $concrete )) {
			return $this->bindings[$abstract]
				? $this->bindings[$abstract] : $concrete;
		}

		//查找接口下的类是否有绑定名称
		return $this->bindings[$abstract][$concrete]
			? $this->bindings[$abstract][$concrete] : $concrete;

	}

	//搜索接口下的绑定某类的实现类
	public function searchBindInterfaceClass( $abstract, $concrete, $className ) {
		
		dump($this->bindings[$abstract]);
		$test = $this->bindings[$abstract][$className];
		dump( $test );
		// foreach ( $test as $key=>$value ) {
		// 	if ( $test[$key] == $concrete )
		// 		$bbbbb[] = $key;
		// }
		dump($bbbbb);
		
		die();
	}

	//实例化并反射类
	public function getInstance( $abstract, $concrete ) {

		if ( $this->bindings[$concrete] )
			$concrete = $this->bindings[$concrete];
		
		//判断是否存在
		if ( false == class_exists( $concrete ))
			die( 'getInstance: concrete '.$concrete.' not found' );

		$reflecter = new ReflectionClass( $concrete );

		$constructor = $reflecter->getConstructor();
		
		$instance = array();

		if ( false == $constructor ) 
			return $reflecter->newInstanceArgs( $instance );

		$parameters = $constructor->getParameters();
		foreach ( $parameters as $param ) {
			dump( $param );
			echo $param;
			if ( $this->bindings[$param->name] ) {
				echo 123;
				
				//$param = $this->bindings[$param->name];
				$instance[] = $this->getInstance( $param );
			} else {
				$class = $param->getClass();
				dump($parameters);
				dump($class);
				echo 999;
				echo $concrete;
				if ( $class ) {
					if ( interface_exists( $class->name ) ) {
						echo  $parameters[0];
						echo  $parameters[1];
						$this->searchBindInterfaceClass( $class->name, $concrete, $parameters[1]->name );
					}
					$instance[] = $this->getInstance( $class->name );
				}
			}
		}

		return $reflecter->newInstanceArgs( $instance );

		// $this->dump( $reflecter );
		// $this->dump( $constructor );
		// $this->dump( $parameters );
	}

	public function run() {

	}

	public function getBind() {
		dump( $this->bindings );
	}

	public function bindAlias() {
		return array(
			'abs' => 'Controller\IndexController',
			'roc' => 'Service\ModelService',

			'ModelInterface' => 'Interfaces\ModelInterface'



			// 'B' => '\Service\B'
		);
	}




}