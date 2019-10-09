<?php

namespace App\Importer;

use App\Helper\githubHelper;

class MergeCommitImporter
{
    public function import()
    {
        $helper = new githubHelper();
        return $helper->callGithub();
    }
}