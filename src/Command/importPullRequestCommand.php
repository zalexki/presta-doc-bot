<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Importer\MergeCommitImporter;

class importPullRequestCommand extends Command
{
    protected static $defaultName = 'github:pullrequest';
    private $importer;

    public function __construct(MergeCommitImporter $importer)
    {
        $this->importer = $importer;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('For get Pull request on PrestaShop repo');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $import = $this->importer->import();
        if ($import['status'] = 'success') {
            $io->success('Pull request is successfuly pushed into your databases!');
        } else {
            $io->error('Error while inserting into your databases!');
        }
    }
}   