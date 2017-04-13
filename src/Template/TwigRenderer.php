<?php declare(strict_types = 1);

namespace JobBoard\Template;

use Twig_Environment;

/**
 * Class TwigRenderer
 *
 * @package JobBoard\Template
 * Twig component implementation for templating
 */
class TwigRenderer implements Renderer
{
    /**
     * @var Twig_Environment
     */
    private $renderer;

    /**
     * TwigRenderer constructor.
     *
     * @param Twig_Environment $renderer
     */
    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param $template
     * @param array    $data
     * @return string
     */
    public function render($template, $data = []) : string
    {
        return $this->renderer->render("$template.html", $data);
    }
}
