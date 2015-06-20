<?php

namespace Crell\HtmlModel;


use Crell\HtmlModel\Link\Linkable;

class HtmlPage implements Linkable
{

    /**
     * Attributes for the HTML element.
     *
     * @todo Convert all of the attributes from arrays to collection objects.
     *
     * @var array
     */
    protected $htmlAttributes = [];

    /**
     * Attributes for the BODY element.
     *
     * @var array
     */
    protected $bodyAttributes = [];

    /**
     * The HTTP status code of this page.
     *
     * @var int
     */
    protected $statusCode = 200;


    public function __construct($content = '', $title = '')
    {
        $this->title = $title;
        $this->htmlAttributes = [];
        $this->bodyAttributes = [];
    }

    /**
     * Returns the HTML attributes for this HTML page.
     *
     * @return array
     */
    public function getHtmlAttributes() {
        return $this->htmlAttributes;
    }

    /**
     * Returns a themed presentation of all JavaScript code for the current page.
     *
     * @param string $scope
     *   (optional) The scope for which the JavaScript rules should be returned.
     *   Defaults to 'header'.
     *
     * @return string
     *   All JavaScript code segments and includes for the scope as HTML tags.
     */
    public function getScripts($scope = 'header') {

    }

    /**
     * Returns a themed representation of all stylesheets to attach to the page.
     *
     * @return string
     *   A string of XHTML CSS tags.
     *
     * @see drupal_get_css()
     */
    public function getStyles() {

    }

    /**
     * Returns the HTML attributes for the body element of this page.
     *
     * @return array
     */
    public function getBodyAttributes() {
        return $this->bodyAttributes;
    }

    /**
     * Sets the HTTP status of this page.
     *
     * @param int $status
     *   The status code to set.
     *
     * @return $this
     *   The called object.
     */
    public function setStatusCode($status) {
        $this->statusCode = $status;
        return $this;
    }

    /**
     * Returns the status code of this response.
     *
     * @return int
     *   The status code of this page.
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getLinks()
    {

    }

}
