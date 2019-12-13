<?php

namespace App\Command;

use App\Importer\MergeCommitImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportAllPullRequestsCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:import:allpullrequests';

    /**
     * @var MergeCommitImporter
     */
    private $importer;

    /**
     * importPullRequestCommand constructor.
     *
     * @param MergeCommitImporter $importer
     */
    public function __construct(MergeCommitImporter $importer)
    {
        $this->importer = $importer;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Retrieve all the pull requests of PrestaShop Docs');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     *
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $import = $this->importer->importAllPullRequest();
        
        if ($import['status'] = 'success') {
            $io->success('Pull request is successfully pushed into your databases!');
        } else {
            $io->error('Error while inserting into your databases!');
        }
    }
}
