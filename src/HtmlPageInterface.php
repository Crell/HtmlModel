<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\BaseElement;
use Crell\HtmlModel\Head\HeadElement;

/**
 * Value object representing an entire HTML page.
 */
interface HtmlPageInterface extends ContentElementInterface, StatusCodeContainerInterface, StyleContainerInterface, ScriptContainerInterface, HeadElementContainerInterface
{
    /**
     * Returns the page with the base element set.
     *
     * @todo Should this take a string instead of an ElementObject?
     *
     * @param BaseElement $base
     *   The base element to set.
     *
     * @return static
     */
    public function withBase(BaseElement $base);

    /**
     * Returns the page with the base element unset.
     *
     * @return static
     */
    public function withoutBase();

    /**
     * Returns the current base element of the page.
     *
     * @return BaseElement
     */
    public function getBase();

    /**
     * Returns the HTML attributes for this HTML page.
     *
     * @return AttributeBag
     */
    public function getHtmlAttributes();

    /**
     * Returns a copy of the page with the HTML attribute set.
     *
     * @param string $key
     *   The attribute to set.
     * @param string|array $value
     *   The value to which to set it.
     *
     * @return static
     */
    public function withHtmlAttribute($key, $value);

    /**
     * Returns the HTML attributes for the body element of this page.
     *
     * @return AttributeBag
     */
    public function getBodyAttributes();

    /**
     * Returns a copy of the page with the BODY attribute set.
     *
     * @param string $key
     *   The attribute to set.
     * @param string|array $value
     *   The value to which to set it.
     *
     * @return static
     */
    public function withBodyAttribute($key, $value);

    /**
     * Returns a copy of the page with the provided HeadElement added.
     *
     * @param HeadElement $element
     *   The HeadElement to add.
     *
     * @return static
     */
    public function withHeadElement(HeadElement $element);

    /**
     * Returns an array of all Head elements on this object.
     *
     * Remember that some head-scoped elements may have their own alternate
     * colletions and won't be included here.
     *
     * @return HeadElement[]
     */
    public function getHeadElements();

    /**
     * Returns the title of the page.
     *
     * @return string
     *   The title of the Page.
     */
    public function getTitle();

    /**
     * Returns a copy of the page with the title set.
     *
     * @param string $title
     *   The title of the page to set.
     *
     * @return static
     */
    public function withTitle($title);

    /**
     * {@inheritdoc}
     */
    public function getLinks();

    /**
     * Returns an array of all elements that should appear in the <head>.
     *
     * Scripts that should appear in the footer are not included.
     *
     * Note: Title is excluded from this list as it is not modeled as a
     * HeadElement. Maybe it should be?
     *
     * @return HeadElement[]
     */
    public function getAllHeadElements();
}
