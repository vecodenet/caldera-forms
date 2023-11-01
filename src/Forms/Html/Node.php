<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

use RuntimeException;

class Node {

    use HasChildNodes,
        HasAttributes;

    /**
     * Node type
     */
    protected NodeTypes $type;

    /**
     * Node value
     */
    protected string $value;

    /**
     * Parent Node
     */
    protected ?Node $parent = null;

    /**
     * Previous Node
     */
    protected ?Node $previous = null;

    /**
     * Next Node
     */
    protected ?Node $next = null;

    /**
     * Constructor
     * @param string $type Node type
     */
    public function __construct(NodeTypes $type = NodeTypes::Element) {
        $this->type = $type;
    }

    /**
     * Static factory function
     * @param string $type Node type
     */
    public static function createNode(NodeTypes $type = NodeTypes::Element) {
        return new static($type);
    }

    /**
     * Get parent Node
     */
    public function getParent(): ?Node {
        return $this->parent;
    }

    /**
     * Get previous node
     */
    public function getPrevious(): ?Node {
        return $this->previous;
    }

    /**
     * Get next node
     */
    public function getNext(): ?Node {
        return $this->next;
    }

    /**
     * Get node type
     */
    public function getType(): NodeTypes {
        return $this->type;
    }

    /**
     * Get node value
     */
    public function getValue(): string {
        return $this->value;
    }

    /**
     * Set node parent
     * @return $this
     */
    public function setParent(?Node $parent): self {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Set node previous
     * @return $this
     */
    public function setPrevious(?Node $previous): self {
        $this->previous = $previous;
        return $this;
    }

    /**
     * Set node next
     * @return $this
     */
    public function setNext(?Node $next): self {
        $this->next = $next;
        return $this;
    }

    /**
     * Set node value
     * @return $this
     */
    public function setValue(string $value): self {
        if ( $this->type != NodeTypes::Text ) {
            throw new RuntimeException('Only text nodes can have a value');
        }
        $this->value = $value;
        return $this;
    }

    /**
     * Detach node
     * @return $this
     */
    public function detach(): self {
        # Detach from parent
        if ($this->parent) {
            if ($this->parent->getFirstChild() === $this) {
                $this->parent->setFirstChild($this->next);
            }
            if ($this->parent->getLastChild() === $this) {
                $this->parent->setLastChild($this->previous);
            }
        }
        # Detach from siblings
        if ($this->previous) {
            # Next item of previous sibling should be our next item
            $this->previous->setNext($this->next);
            if ($this->next) {
                $this->next->setPrevious($this->previous);
            }
        }
        if ($this->next) {
            # Previous item of next sibling should be our previous item
            $this->next->setPrevious($this->previous);
            if ($this->previous) {
                $this->previous->setNext($this->next);
            }
        }
        $this->parent = null;
        $this->previous = null;
        $this->next = null;
        return $this;
    }

    /**
     * Add node before
     * @param  Node   $node Node to add
     * @return $this
     */
    public function before(Node $node): self {
        if ($this->previous) {
            # Fix previous node
            $this->previous->setNext($node);
            $node->setPrevious($this->previous);
        }
        $this->previous = $node;
        $node->setNext($this);
        if ($this->parent) {
            # Set same parent
            $node->setParent($this->parent);
            if ($this->parent->getFirstChild() === $this) {
                # Set new first child
                $this->parent->setFirstChild($node);
            }
        }
        return $this;
    }

    /**
     * Add node after
     * @param  Node   $node Node to add
     * @return $this
     */
    public function after(Node $node): self {
        if ($this->next) {
            # Fix next node
            $this->next->setPrevious($node);
            $node->setNext($this->next);
        }
        $this->next = $node;
        $node->setPrevious($this);
        if ($this->parent) {
            # Set same parent
            $node->setParent($this->parent);
            if ($this->parent->getLastChild() === $this) {
                # Set new last child
                $this->parent->setLastChild($node);
            }
        }
        return $this;
    }
}
