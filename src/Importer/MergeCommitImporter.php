<?php

namespace App\Importer;

use App\Helper\githubHelper;
use App\Converter\MergeCommitConverter;

class MergeCommitImporter
{
    public function import()
    {
        $helper = new githubHelper();
        $converter = new MergeCommitConverter();
        $githubResponse = $helper->callGithub();
        return $converter->convert($githubResponse);
    }
}