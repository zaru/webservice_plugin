<?php
/**
 * Webservice Component
 *
 * Triggers the Webservice View
 *
 * PHP version 5
 *
 * Copyright 2010-2012, Jose Diaz-Gonzalez
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the below copyright notice.
 *
 * @copyright   Copyright 2010-2012, Jose Diaz-Gonzalez
 * @package     Webservice
 * @subpackage  Webservice.Controller.Component
 * @link        http://github.com/josegonzalez/webservice_plugin
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 **/
class WebserviceComponent extends Component {

	public $settings = array();

/**
 * Constructor
 *
 * @param ComponentCollection $collection A ComponentCollection for this component
 * @param array $settings Array of settings.
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->settings = $settings;
	}
	
/**
 * Called before the Controller::beforeFilter().
 *
 * @param object  A reference to the controller
 * @return void
 * @access public
 * @link http://book.cakephp.org/view/65/MVC-Class-Access-Within-Components
 */
	public function initialize(&$controller) {

		$this->settings = array_merge(array(
			'blacklist' => array(),
		), (array) $this->settings);
		if (isset($controller->webserviceBlacklist)) {
			$this->settings['blacklist'] = array_merge(
				(array) $this->settings['blacklist'],
				(array) $controller->webserviceBlacklist
			);
		}

		if (in_array('*', $this->settings['blacklist'])) {
			throw new MethodNotAllowedException();
			return;
		}
		
		if (in_array($controller->request->params['action'], $this->settings['blacklist'])) {
			throw new MethodNotAllowedException();
			return;
		}

		if (in_array($controller->request->ext, array('json', 'xml'))) {
			$controller->viewClass = 'Webservice.Webservice';
		}
	}
/**
 * RequestHandler‚É‚æ‚Á‚ÄvieweClass‚ªæ‚ÁŽæ‚ç‚ê‚é‚Ì‚ÅA‚±‚Á‚¿‚ÅÄ“x‘‚«Š·‚¦‚é‚æ‚¤‚É‚·‚é
 *
 * @param object  A reference to the controller
 * @return void
 * @access public
 * @link http://book.cakephp.org/view/65/MVC-Class-Access-Within-Components
 */
	public function beforeRender(&$controller) {
		if (in_array($controller->request->ext, array('json', 'xml'))) {
			$controller->viewClass = 'Webservice.Webservice';
		}
	}
}