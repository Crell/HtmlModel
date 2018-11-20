<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\ScriptElement;

/**
 * Interface for classes that can contain script elements.
 */
interface ScriptContainerInterface
{
    /**
     * Returns a copy of the page with the script added.
     *
     * @param ScriptElement $script
     * @param string $scope
     *   The scope in which the script should be defined. Legal values are "header"
     *   (i.e., in the <head> element) and "footer" (i.e., right before </body>).
     *
     * @return static
     */
    public function withScript(ScriptElement $script, $scope = 'header');

    /**
     * Returns the Script elements on this Page.
     *
     * @param string $scope
     *   The scope for which to return Script elements.
     *
     * @return ScriptElement[]
     *   All JavaScript elements for the specified scope.
     */
    public function getScripts($scope = 'header') : iterable;
}
