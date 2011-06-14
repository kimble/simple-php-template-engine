<?php

/**
 * Simple template class based on output buffering. 
 * @author Kim A. Betti
 */
class View {

    protected $viewFile;
    protected $vars = array();

    /**
     * Construct a view based on a template path. 
     * @param string $viewFile Path to template file
     */
    public function __construct($viewFile) {
        $this->viewFile = $viewFile;
    }

    /**
     * Convenient way of setting multiple key / value pairs. 
     * @param array $data Data to be injected into the view
     */
    public function setFromArray(array $data) {
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Inject a key / value pair into the template data. 
     * @param string $key Name of the variable to set inside the template
     * @param mixed $value Value that to be associated with the key
     */
    public function set($key, $value) {
        $this->vars[$key] = $value;
    }
    
    public function get($key) {
        return $this->vars[$key];
    }
    
    public function getData() {
        return $this->vars;
    }

    public function render() {
        $this->setRefences();
        ob_start();
        extract($this->vars);
        require($this->viewFile);
        return ob_get_clean();
    }
    
    private function setRefences() {
        $this->vars["view"] = $this;
    }

}