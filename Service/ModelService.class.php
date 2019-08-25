<?php
namespace Service;

use Interfaces\ModelInterface;

class ModelService implements ModelInterface
{

	// public $model;

	public function __construct() {
		// $this->model = $Model;
	}

	public function connection() {
		echo __CLASS__;
	}

	public function say() {
		// $this->model->say();
		echo 4444;
	}


}