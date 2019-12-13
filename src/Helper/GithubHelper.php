<?php

namespace App\Helper;

use Github\Client;

class GithubHelper
{
    /**
     * @return array
     */
    public function getAllPullRequests(): array
    {
        $githubClient = new Client();

        return $githubClient
            ->api('pulls')
            ->all('Prestashop', 'docs', [
                'sha' => 'master', 
                'state' => 'all',
                'sort' => 'created',
                'direction' => 'desc',
                'per_page' => '100'
            ])
        ;
    }
}
