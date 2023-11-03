<?php

namespace Controller;

use Controller\BaseController;

class HomeController extends BaseController
{
    public function liste()
    {
        $this->render("home.html.php");
    }
}
