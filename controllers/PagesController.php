<?php

namespace app\controllers;

class PagesController extends \lithium\action\Controller {

	public function view() {
        $path = (func_get_args()) ?: array('home');
		$this->render(array('template' => join('/', $path)));
	}
}

?>
