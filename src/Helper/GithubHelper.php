<?php

namespace App\Helper;

use Github\Client;

class GithubHelper
{
    /**
     * @return array
     */
    public function callGithub(): array
    {
        $githubClient = new Client();

        return $githubClient->api('pulls')->all('Prestashop', 'Prestashop', ['sha' => 'master']);
    }
}
