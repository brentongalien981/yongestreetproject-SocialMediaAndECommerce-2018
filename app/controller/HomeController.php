<?php
namespace App\Controller;

use App\Core\Main\MainController;

class HomeController extends MainController
{
    public function __construct($menu = null, $action = null)
    {
        parent::__construct($menu, $action);
    }


    /** @override */
    public function index()
    {
        // require_once(PUBLIC_PATH . 'video/create.php');
        echo "TODO: home/index/index.php...";
    }
}
