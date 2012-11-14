# Webservice Plugin 2.0

CakePHP2.2.xで使用したさいに、$this->viewClassがRequestHandlerによって書き換えられてしまい、うまく表示できなかったので、Component->initialize()で初期化するのではなくComponent->beforeRender()で書き換えるように修正。

## Usage

	<?php
	class PostsController extends AppController {

		public $components = array(
			'RequestHandler',
			'Webservice.Webservice'
		);
		public function index() {
			$posts = array();
			$this->set(compact('posts'));
		}

	}