<?php
namespace Model;

use Interfaces\ModelInterface;

class Model implements ModelInterface
{

	public function __construct() {

	}

	public function connection() {
		echo __CLASS__;
	}

	public function say() {
		echo 'my name is Model';
	}


}