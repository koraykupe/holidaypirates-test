<?php


namespace JobBoard\Template;

use Mustache_Engine;

/**
 * Class MustacheRenderer
 * @package JobBoard\Template
 * Mustache Engine implementation for template rendering
 */
class MustacheRenderer implements Renderer
{
    /**
     * @var Mustache_Engine
     */
    private $engine;

    /**
     * MustacheRenderer constructor.
     * @param Mustache_Engine $engine
     */
    public function __construct(Mustache_Engine $engine)
    {
        $this->engine = $engine;
    }

    /**
     * @param $template
     * @param array $data
     * @return string
     */
    public function render($template, $data = []) : string
    {
        return $this->engine->render($template, $data);
    }
}