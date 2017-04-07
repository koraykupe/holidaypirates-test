<?php declare(strict_types = 1);

namespace JobBoard\Template;

/**
 * Interface Renderer
 * @package JobBoard\Template
 */
interface Renderer
{
    /**
     * @param $template
     * @param array $data
     * @return string
     */
    public function render($template, $data = []) : string;
}