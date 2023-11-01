<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

class Element extends Node {

    /**
     * Element tag
     */
    protected string $tag;

    /**
     * Self-closing flag
     */
    protected bool $self_closing;

    /**
     * Constructor
     * @param string $tag Element tag
     */
    public function __construct(string $tag = 'div') {
        parent::__construct(NodeTypes::Element);
        $this->tag = strtolower($tag);
        $this->self_closing = in_array($tag, ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr']);
    }

    /**
     * Static factory function
     * @param string $type Node type
     */
    public static function createElement(string $tag = 'div') {
        return new static($tag);
    }

    /**
     * Set id attribute
     * @param  string $id Attribute value
     * @return $this
     */
    public function setId(string $id): self {
        $this->setAttribute('id', $id);
        return $this;
    }

    /**
     * Set class attribute
     * @param  string $class Attribute value
     * @return $this
     */
    public function setClass(string $class): self {
        $this->setAttribute('class', $class);
        return $this;
    }

    /**
     * Set element content
     * @param Node|string $content Element content
     */
    public function setContent(Node|string $content) {
        if ( is_string($content) ) {
            $node = new Node(NodeTypes::Text);
            $node->setValue($content);
            $this->first_child = $node;
            $this->last_child = $node;
        } else {
            $this->empty();
            $this->first_child = $content;
            $node = $content->getNext();
            while($node !== null) {
                $this->last_child = $node;
                $node = $node->getNext();
            }
        }
        return $this;
    }

    /**
     * Get element tag
     */
    public function getTag(): string {
        return $this->tag;
    }

    /**
     * Get element content
     */
    public function getContent(): string {
        $attributes = $this->buildAttributes();
        $html = $attributes ? "<{$this->tag} {$attributes}>" : "<{$this->tag}>";
        $child = $this->first_child;
        while ($child !== null) {
            $html .= ($child instanceof Element) ? $child->getContent() :  $child->getValue();
            $child = $child->getNext();
        }
        if (! $this->self_closing ) {
            $html .= "</{$this->tag}>";
        }
        return $html;
    }

    /**
     * Wrap an element around
     * @param  Element $element Element to wrap into
     * @return $this
     */
    public function wrap(Element $element): self {
        $element->append($this);
        return $this;
    }

    /**
     * Unwrap parent element
     * @return $this
     */
    public function unwrap(): self {
        if ( $this->parent ) {
            $old_parent = $this->parent;
            $this->detach();
            if ( $old_parent->getParent() ) {
                $old_parent->getParent()->append($this);
            }
        }
        return $this;
    }
}
