<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'CreateUser';
    protected static $defaultDescription = 'Create a user in filecloud webservice';

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the user')
            ->addArgument('email', InputArgument::REQUIRED, 'Email of the user')
            ->addArgument('password', InputArgument::REQUIRED, 'Password of the user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        // Create an instance of the HTTP client
        $client = HttpClient::create();

        // Set the URL of the webservice endpoint
        $url = 'http://127.0.0.1/admin/adduser';

        // Set the data to send in the POST request
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

        // Send the POST request
        $response = $client->request('GET', $url, [
            'query' => $data
        ]);

        $status = $response->getStatusCode();

        if ($status === 200) {
            // handle successful response

            // Get the response content
            // $content = $response->getContent();
            // $xml = new \SimpleXMLElement($content);

            $io->success('User created!');

            return Command::SUCCESS;
        } else {
            $io->error('Failure while sending information to filecloud');
            return Command::FAILURE;
        }
        
    }
}
