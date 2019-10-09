<?php

namespace App\Helper;

use Github\Client;
use App\Converter\MergeCommitConverter;

class githubHelper
{
    public function callGithub() : Array
    {
        $githubClient = new Client();
        $converter = new MergeCommitConverter();
        return $converter->getDataFromGithub($githubClient->api('repo')->commits()->all('Prestashop', 'Prestashop', array('sha' => 'master')));
    }
}