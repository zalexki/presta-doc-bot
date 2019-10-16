<?php

namespace App\Helper;

use Github\Client;

class githubHelper
{
    public function callGithub() : Array
    {
        $githubClient = new Client();
        return $githubClient->api('pr')->all('Prestashop', 'Prestashop', array('sha' => 'master'));
    }
}