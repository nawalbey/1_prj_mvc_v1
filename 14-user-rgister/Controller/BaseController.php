<?php

namespace Controller;


use Service\Session;

abstract class BaseController
{
    public function render($fichier, array $parametres = [])
    {
        extract($parametres);
        include "public/header.html.php";
        include "views/$fichier";
        include "public/footer.html.php";
    }

    public function getUser()
    {
        $user = Session::isConnected();

        if (!$user) {
            redirection("/error/403.php");
        }
        return $user;
    }

    public function getAdmin()
    {
        $user = Session::isAdmin();

        if (!$user) {
            redirection("/error/403.php");
        }
        return $user;
    }

    public function setMessage($type, $message)
    {
        Session::addMessage($type, $message);
    }
}
