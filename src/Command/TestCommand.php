<?php
namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{   
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct();
    }

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:test-command';

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
{
    // outputs multiple lines to the console (adding "\n" at the end of each line)
    $output->writeln([
        'Test test',
        '============',
        '',
    ]);

    // the value returned by someMethod() can be an iterator (https://secure.php.net/iterator)
    // that generates and returns the messages with the 'yield' PHP keyword
    

    // outputs a message followed by a "\n"
    $output->writeln('Whoa!');

    // outputs a message without adding a "\n" at the end of the line
    $output->write('You are about to ');
    $output->write('create a command.');

    $this->logger->info('test command whoa');
    return Command::SUCCESS;
}
}