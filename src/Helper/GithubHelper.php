<?php

namespace App\Helper;

use Github\Client;

class GithubHelper
{
    /**
     * @return Array
     */
    public function callGithub(): array
    {
        $githubClient = new Client();
        return $githubClient->api('pulls')->all('Prestashop', 'Prestashop', array('sha' => 'master'));
    }
}
