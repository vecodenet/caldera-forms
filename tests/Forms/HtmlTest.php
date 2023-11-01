<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Tests\Forms;

use RuntimeException;

use PHPUnit\Framework\TestCase;

use Caldera\Forms\Html\Node;
use Caldera\Forms\Html\Element;
use Caldera\Forms\Html\NodeTypes;

class HtmlTest extends TestCase {

    public function testCreateElement() {
        $element = Element::createElement('p')->setContent('Lorem ipsum dolor sit amet.');
        $this->assertNull( $element->getPrevious() );
        $this->assertNull( $element->getNext() );
        $this->assertNull( $element->getParent() );
        $this->assertInstanceOf(Node::class, $element->getFirstChild() );
        $this->assertInstanceOf(Node::class, $element->getLastChild() );
        $this->assertEquals(NodeTypes::Element, $element->getType() );
        $this->assertEquals('p', $element->getTag() );
        $this->assertEquals('<p>Lorem ipsum dolor sit amet.</p>', $element->getContent() );
        $this->expectException(RuntimeException::class);
        $element->setValue('Lorem ipsum dolor sit amet.');
    }

    public function testAttributes() {
        $element = Element::createElement('button');
        $element->setAttributes(['type' => 'submit', 'class' => 'btn btn-primary']);
        $element->setAttribute('disabled', true);
        $this->assertCount(3, $element->getAttributes());
        $this->assertTrue($element->hasAttribute('disabled'));
        $this->assertTrue($element->getAttribute('disabled'));
        $this->assertEquals('class="btn btn-primary" disabled type="submit"', $element->buildAttributes());
        $element->setAttribute('disabled', false);
        $this->assertFalse($element->hasAttribute('disabled'));
    }

    public function testGetChildAtLowerThanZero() {
        $container = Element::createElement();
        $this->expectException(RuntimeException::class);
        $container->removeChild( $container->getChildAt(-1) );
    }

    public function testGetChildAtGreaterThanMax() {
        $container = Element::createElement();
        for ($i = 0; $i < 3; $i++) {
            $item = Element::createElement();
            $container->append($item);
        }
        $this->expectException(RuntimeException::class);
        $container->removeChild( $container->getChildAt(5) );
    }

    public function testAfterBefore() {
        $container = Element::createElement('article');
        $items = [];
        for ($i = 0; $i < 5; $i++) {
            $items[] = Element::createElement('p')->setContent('Paragraph ' . $i + 1);
        }
        $this->assertEquals('<article></article>', $container->getContent());
        $container->append( $items[0] );
        $this->assertEquals('<article><p>Paragraph 1</p></article>', $container->getContent());
        $container->getFirstChild()->before( $items[1] );
        $this->assertEquals('<article><p>Paragraph 2</p><p>Paragraph 1</p></article>', $container->getContent());
        $container->getLastChild()->after( $items[2] );
        $this->assertEquals('<article><p>Paragraph 2</p><p>Paragraph 1</p><p>Paragraph 3</p></article>', $container->getContent());
        $container->getFirstChild()->after( $items[3] );
        $this->assertEquals('<article><p>Paragraph 2</p><p>Paragraph 4</p><p>Paragraph 1</p><p>Paragraph 3</p></article>', $container->getContent());
        $container->getLastChild()->before( $items[4] );
        $this->assertEquals('<article><p>Paragraph 2</p><p>Paragraph 4</p><p>Paragraph 1</p><p>Paragraph 5</p><p>Paragraph 3</p></article>', $container->getContent());
        $this->assertEquals(5, $container->getChildCount());
    }

    public function testDetach() {
        $container = Element::createElement();
        for ($i = 0; $i < 10; $i++) {
            $item = Element::createElement();
            $container->append($item);
        }
        $this->assertEquals(10, $container->getChildCount());
        $container->removeChild( $container->getFirstChild() );
        $this->assertEquals(9, $container->getChildCount());
        $container->removeChild( $container->getLastChild() );
        $this->assertEquals(8, $container->getChildCount());
        $container->removeChild( $container->getChildAt(4) );
        $this->assertEquals(7, $container->getChildCount());
    }

    public function testEmpty() {
        $container = Element::createElement();
        for ($i = 0; $i < 10; $i++) {
            $item = Element::createElement();
            $container->append($item);
        }
        $container->empty();
        $this->assertEquals(0, $container->getChildCount());
    }

    public function testElementManipulation() {
        $main = Element::createElement()
            ->setAttribute('id', 'main');
        $heading = Element::createElement('h1')
            ->setContent('Lorem ipsum');
        $container = Element::createElement()
            ->setAttribute('id', 'container');
        $paragraph = Element::createElement('p')
            ->setAttribute('id', 'paragraph')
            ->setAttribute('class', 'text-center')
            ->setContent('Lorem ipsum dolor sit amet consectetur adipisicing elit.');
        $anchor = Element::createElement('a')
            ->setAttribute('id', 'anchor')
            ->setContent('Website')
            ->setAttribute('href', 'https://vecode.net');
        $ruler = Element::createElement('hr')
            ->setAttribute('id', 'ruler');
        #
        $container->prepend($paragraph);
        $paragraph->append($anchor);
        $container->append($ruler);
        $container->prepend($heading);
        #
        $this->assertEquals( 3, $container->getChildCount() );
        $this->assertEquals( $container, $paragraph->getParent() );
        $this->assertEquals( $heading, $container->getFirstChild() );
        $this->assertEquals( $ruler, $container->getLastChild() );
        #
        $container->removeChild($ruler);
        #
        $this->assertEquals( $paragraph, $container->getLastChild() );
        #
        $container->wrap($main);
        $this->assertEquals( $main, $container->getParent() );
        #
        $paragraph->unwrap();
        $this->assertEquals( $main, $paragraph->getParent() );
    }

    public function testSetContent() {
        $paragraph = Element::createElement('p')->setContent('Lorem ipsum dolor sit amet.');
        $this->assertEquals('<p>Lorem ipsum dolor sit amet.</p>', $paragraph->getContent());
        $content = Element::createElement('strong')->setContent('dolor');
        $content->before( Node::createNode(NodeTypes::Text)->setValue('Lorem ipsum ') );
        $content->after( Node::createNode(NodeTypes::Text)->setValue(' sit amet.') );
        $paragraph = Element::createElement('p')->setContent( $content->getPrevious() );
        $this->assertEquals('<p>Lorem ipsum <strong>dolor</strong> sit amet.</p>', $paragraph->getContent());
    }

    protected function debugTree(Node $node, int $level = 0): void {
        $parent = $node->getParent();
        $first_child = $node->getFirstChild();
        $last_child = $node->getLastChild();
        echo str_repeat('-', $level) . ($node instanceof Element ? "[{$node->getTag()}]#" : '[TextNode]') . $node->getAttribute('id') . ', parent: ' . ($parent ? $parent->getAttribute('id') : 'none') . ', first child: ' . ($first_child ? ($first_child instanceof Element ? $first_child->getAttribute('id') : '[TextNode]') : 'none') . ', last child: ' . ($last_child ? ($last_child instanceof Element ? $last_child->getAttribute('id') : '[TextNode]') : 'none') . PHP_EOL;
        $child = $node->getFirstChild();
        while ($child) {
            $this->debugTree($child, $level + 1);
            $child = $child->getNext();
        }
    }
}
