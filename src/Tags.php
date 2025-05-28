<?php

namespace mindplay\vite;

/**
 * @see Manifest::createTags()
 */
class Tags
{
    public string $preload;
    public string $css;
    public string $js;

    public function __construct(string $preload = '', string $css = '', string $js = '')
    {
        $this->preload = $preload;
        $this->css = $css;
        $this->js = $js;
    }
}
