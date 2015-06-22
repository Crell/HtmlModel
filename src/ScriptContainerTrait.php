<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\ScriptElement;

trait ScriptContainerTrait
{
    /**
     * A collection of the scripts defined for this page.
     *
     * Both the header and footer arrays are an array of ScriptElement objects.
     *
     * @todo: Should this be a more formal data structure? Probably.
     *
     * @var array
     */
    private $scripts = [
      'header' => [],
      'footer' => [],
    ];


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
    public function withScript(ScriptElement $script, $scope = 'header')
    {
        // These are the only legal values.
        assert('in_array($scope, [\'header\', \'footer\'])');

        $that = clone($this);
        $this->scripts[$scope][] = $script;
        return $that;
    }

    /**
     * Returns the Script elements on this Page.
     *
     * @param string $scope
     *   The scope for which to return Script elements.
     *
     * @return ScriptElement[]
     *   All JavaScript elements for the specified scope.
     */
    public function getScripts($scope = 'header') {
        return $this->scripts[$scope];
    }
}
