<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;
class Twig
{
    protected $twig;

    public function __construct()
    {

        $loader = new \Twig\Loader\FilesystemLoader(APPPATH . 'views');

         $this->twig = new \Twig\Environment($loader, [

            'cache' => false,

            'debug' => true
     ]);
         $ci = get_instance();

        // Add base_url Twig function
        $this->twig->addFunction(new TwigFunction('base_url', function ($uri = '') use ($ci) {
            return $ci->config->base_url($uri);
        }));
        $ci->load->helper('form');

         $this->twig->addFunction(new \Twig\TwigFunction('form_open', function($action = '', $attributes = []) use ($ci) {

            return form_open($action, $attributes);

        }, ['is_safe' => ['html']]));

        // form_close

        $this->twig->addFunction(new \Twig\TwigFunction('form_close', function() use ($ci) {

             return form_close();

            }, ['is_safe' => ['html']]));
    }
           public function render($view, $data = [])
        {
         // Returns rendered template as string

         return $this->twig->render($view . '.twig', $data);
}



}
