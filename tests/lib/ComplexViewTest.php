<?php
require_once dirname(__FILE__) . '/../../lib/ComplexView.php';

class ComplexViewTest extends PHPUnit_Framework_TestCase {

    public function testRenderLayoutWithSingleView() {
        $layout = new ComplexView("data/layout.php");
        $layout->set("title", "Programming is fun");
        
        $contentView = new View("data/content-view.php");
        $contentView->set("title", "Programming is a lot of fun!");
        $contentView->set("contents", "<p>Some text explaining why programming is so much fun</p>");
        
        $layout->addView("contents", $contentView);
        $renderedHtml = $layout->render();
        
        $this->assertContains("<title>Programming is fun</title>",  $renderedHtml);
        $this->assertContains("<h1>Programming is a lot of fun!</h1>",  $renderedHtml);
        $this->assertContains("<p>Some text explaining why programming is so much fun</p>",  $renderedHtml);
    }

}