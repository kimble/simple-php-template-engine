<?php
require_once dirname(__FILE__) . '/View.php';

/**
 * Provides layout functionality by composing
 * multiple view instances together. 
 * @author Kim A. Betti
 */
class ComplexView extends View {

	private $views = array();

	/**
     * Construct a view based on a template path. 
     * @param string $viewFile Path to template file
     */
	public function __construct($layoutFile) {
		parent::__construct($layoutFile);
	}

    /**
     * Add a view using a given name. 
     * @param string $name Name of the view used in the layout
     * @param View $view The instance to be associated with the name
     */
	public function addView($name, View $view) {
		$this->views[$name] = $view;
	}

	public function render() {
		foreach ($this->views as $viewName => $view) {
			$view->set("layout", $this);
			$this->vars[$viewName] = $view->render();
		}
        
		return parent::render();
	}

}