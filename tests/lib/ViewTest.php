<?php
require_once dirname(__FILE__) . '/../../lib/View.php';

class ViewTest extends PHPUnit_Framework_TestCase {

    public function testInitialDataSetShouldBeEmpty() {
        $view = new View(null);
        $this->assertEquals(0, count($view->getData()));
    }
    
    public function testSetDataFromArray() {
        $view = new View(null);
        $data = array("name" => "Peter", "age" => 20);
        $view->setFromArray($data);
        $this->assertEquals(2, count($view->getData()));
        $this->assertEquals("Peter", $view->get("name"));
        $this->assertEquals(20, $view->get("age"));
    }
    
    public function testSimpleTemplate() {
        $view = new View("data/simple-view.php");
        $view->set("title", "Site title");
        $renderedHtml = $view->render();
        $this->assertEquals("<title>Site title</title>", $renderedHtml);
    }

}