<?php

/**
 * Dead simple example of Bloge application
 * 
 * @package bloge/advanced-pack
 */

use Bloge\Apps\AdvancedApp;
use Bloge\Content\Advanced;
use Bloge\Content\FrontMatter as Content;
use Bloge\Renderers\Twig as Renderer;

$content = __DIR__ . '/content';
$theme   = __DIR__ . '/theme';

$content = new Advanced(new Content($content));
$content->processor()
    ->add(Bloge\processMerge('header', 'spyc_load'))
    ->add(Bloge\process('content', [new Parsedown, 'text']));

return new AdvancedApp($content, new Renderer($theme));