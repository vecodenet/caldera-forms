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

trait HasChildNodes {

    /**
     * First child Node
     */
    protected ?Node $first_child = null;

    /**
     * Last child Node
     */
    protected ?Node $last_child = null;

    /**
     * Get children nodes
     */
    public function getFirstChild(): ?Node {
        return $this->first_child;
    }

    /**
     * Get children nodes
     */
    public function getLastChild(): ?Node {
        return $this->last_child;
    }

    /**
     * Remove all children nodes
     * @return $this
     */
    public function empty(): self {
        $child = $this->first_child;
        while ($child) {
            $old_next = $child->getNext();
            $child->detach();
            $child = $old_next;
        }
        $this->first_child = null;
        $this->last_child = null;
        return $this;
    }

    public function removeChild(Node $node) {
        $child = $this->first_child;
        while ($child) {
            if ($child === $node) {
                # Found, remove it
                $node->detach();
            }
            $child = $child->getNext();
        }
    }

    /**
     * Get child nodes count
     */
    public function getChildCount(): int {
        $count = 0;
        $child = $this->first_child;
        while ($child) {
            $count++;
            $child = $child->getNext();
        }
        return $count;
    }

    /**
     * Get child node at index
     */
    public function getChildAt(int $index): ?Node {
        if ($index < 0) {
            throw new RuntimeException('Index must be greater than or equal to zero');
        }
        $max = $this->getChildCount();
        if ($index >= $max) {
            throw new RuntimeException("Index must be lower than {$max}");
        }
        $count = 0;
        $child = $this->first_child;
        while ($child) {
            if ($count == $index) {
                return $child;
            }
            $count++;
            $child = $child->getNext();
        }
    }

    /**
     * Set first child
     * @return $this
     */
    public function setFirstChild(?Node $first_child): self {
        $this->first_child = $first_child;
        return $this;
    }

    /**
     * Set last child
     * @return $this
     */
    public function setLastChild(?Node $last_child): self {
        $this->last_child = $last_child;
        return $this;
    }

    /**
     * Prepend node
     * @param  Node   $node Node to prepend
     * @return $this
     */
    public function prepend(Node $node): self {
        $node->detach();
        $node->setParent($this);
        if ( $this->first_child === null ) {
            # Empty case, just set as first and last
            $this->first_child = $node;
            $this->last_child = $node;
        } else {
            # Not empty, first insert it before first child
            $this->first_child->setPrevious($node);
            $node->setNext($this->first_child);
            # Set it as the new first child
            $this->first_child = $node;
        }
        return $this;
    }

    /**
     * Append node
     * @param  Node   $node Node to append
     * @return $this
     */
    public function append(Node $node): self {
        $node->detach();
        $node->setParent($this);
        if ( $this->first_child === null ) {
            # Empty case, just set as first and last
            $this->first_child = $node;
            $this->last_child = $node;
        } else {
            # Not empty, first insert it after last child
            $this->last_child->setNext($node);
            $node->setPrevious($this->last_child);
            # Set it as the new last child
            $this->last_child = $node;
        }
        return $this;
    }
}
