<?php

/**
 * Dead simple example of Bloge application
 * 
 * @package bloge/advanced-pack
 */

use Bloge\Apps\AdvancedApp;
use Bloge\Content\Advanced;
use Bloge\Content\FrontMatter as Content;
use Bloge\Renderers\PHP as Renderer;
use Bloge\Renderers\IRenderer;

/**
 * Comment to note:
 * 
 * I'm in process of creating repository specifically dedicated for 
 * either separate renderers adapters or whole bunch of them.
 */
class TwigRenderer implements IRenderer
{
    protected $path;
    protected $twig;
    
    public function __construct($path, array $options = [])
    {
        $this->twig = new Twig_Environment(
            new Twig_Loader_Filesystem($path), $options
        );
    }
    
    public function twig()
    {
        return $this->twig;
    }
    
    public function partial($view, array $data = [])
    {
        return $this->twig->render($view, $data);
    }
    
    public function render(array $data = [])
    {
        $view = isset($data['view']) ? $data['view'] : '';
        
        return $this->partial($view, $data);
    }
}


$content = __DIR__ . '/content';
$theme   = __DIR__ . '/theme';

$content = new Advanced(new Content($content));
$content->processor()
    ->add(Bloge\processMerge('header', 'spyc_load'))
    ->add(Bloge\process('content', [new Parsedown, 'text']));

return new AdvancedApp($content, new TwigRenderer($theme));