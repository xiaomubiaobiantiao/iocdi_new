<?php
namespace Controller;

// include( 'aa.class.php' );
// use aa;
include( 'Interfaces/ModelInterface.class.php' );
use Interfaces\ModelInterface;


class IndexController
{

	public $b;

	public function __construct( ModelInterface $test ) {
		$this->b = $test;
		$this->connection();
	}

	public function connection() {
		$this->b->connection();
	}

	public function say() {
		$this->b->say();
	}


}

