<?php

namespace App\Helper;

use Github\Client;

class githubHelper
{
    // TODO: use pull request API
    // https://github.com/KnpLabs/php-github-api/blob/master/doc/pull_requests.md
    public function callGithub() : Array
    {
        $githubClient = new Client();
        return $githubClient->api('pr')->all('Prestashop', 'Prestashop', array('sha' => 'master'));
    }
}