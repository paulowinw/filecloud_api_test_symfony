<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportInitialUsersCommand extends Command
{
    protected static $defaultName = 'ImportInitialUsers';
    protected static $defaultDescription = 'Add a list of initial users';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Set the parameters for the request
        // Hardcoded
        $users = [
            ['username' => 'HendersonNakashima', 'password' => 'yourpassword', 'groupname' => 'Accounting', 'authtype' => 0],
            ['username' => 'BiserkaWilkie', 'password' => 'yourpassword', 'groupname' => 'Accounting', 'authtype' => 0],
            ['username' => 'GiltbertThatcher', 'password' => 'yourpassword', 'groupname' => 'Accounting', 'authtype' => 0],
            ['username' => 'OctaviaBlanchard', 'password' => 'yourpassword', 'groupname' => 'Accounting', 'authtype' => 0],
            ['username' => 'DawidMorel', 'password' => 'yourpassword', 'groupname' => 'Accounting', 'authtype' => 0],
            ['username' => 'ZülfikarAafjes', 'password' => 'yourpassword', 'groupname' => 'Operations', 'authtype' => 0],
            ['username' => 'VlasiSzilágyi', 'password' => 'yourpassword', 'groupname' => 'Operations', 'authtype' => 0],
            ['username' => 'MadelynDonne', 'password' => 'yourpassword', 'groupname' => 'Operations', 'authtype' => 0],
            ['username' => 'ŞuleZima', 'password' => 'yourpassword', 'groupname' => 'Operations', 'authtype' => 0],
            ['username' => 'RehemaBarr', 'password' => 'yourpassword', 'groupname' => 'Operations', 'authtype' => 0],
            ['username' => 'AweeMurdoch', 'password' => 'yourpassword', 'groupname' => 'Engineering', 'authtype' => 0],
            ['username' => 'TsholofeloBoer', 'password' => 'yourpassword', 'groupname' => 'Engineering', 'authtype' => 0],
            ['username' => 'MariWinthrop', 'password' => 'yourpassword', 'groupname' => 'Engineering', 'authtype' => 0],
            ['username' => 'DragoslavEchevarría', 'password' => 'yourpassword', 'groupname' => 'Consultants', 'authtype' => 0],
            ['username' => 'KaleyPetrov', 'password' => 'yourpassword', 'groupname' => 'Consultants', 'authtype' => 0],
        ];

        $application = $this->getApplication();
        $isThereError = false;

        foreach ($users as $user)
        {
            $input = new ArrayInput([
                'username'=> $user['username'],
                'password'=> $user['password'],
                'authtype' => $user['authtype']
            ]);
            $command = $application->find('CreateUserCommand');
            $result = $command->run($input, $output);
            if (!$result)
            {
                $isThereError = true;
            }
        }

        if ($isThereError)
        {
            $io->error('Failure while sending information to filecloud');
            return Command::FAILURE;
        }

        $io->success('Users created!');
        return Command::SUCCESS;
    }
}
