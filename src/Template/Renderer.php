<?php declare(strict_types = 1);

namespace JobBoard\Template;

interface Renderer
{
    public function render($template, $data = []) : string;
}