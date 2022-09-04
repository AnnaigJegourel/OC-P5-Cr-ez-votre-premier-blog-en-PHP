<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class MainController
 * Manages the Main Features
 * @package App\Controller
 */
abstract class MainController
{
    /**
     * @var Environment|null
     */
    protected $twig = null;

    /**
     * @var array
     */
    private $session = [];

    /**
     * MainController constructor
     * Creates the Template Engine & adds its Extensions
     */
    public function __construct()
        {
            $this->twig = new Environment(new FilesystemLoader("../src/View"), array("cache"=>false));
            $this->session = filter_var_array($_SESSION) ?? [];
        }
    
    /**
     * Get Session Array
     * @param null|string $var
     * @return array|string
     */
    protected function getSession()
    {
        return $this->session;
    }

            /**
     * Returns current id
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function getId()
    {
        return filter_input(INPUT_GET, 'id');
    }

    /**
     * Redirects to another URL
     * @param string $page
     * @param array $params
     */
    public function redirect(string $page, array $params = [])
    {
        $params["access"] = $page;
        header("Location: index.php?" . http_build_query($params));
        
        exit;
    }
};