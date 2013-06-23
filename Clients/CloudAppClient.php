<?php
namespace Dizda\CloudBackupBundle\Clients;

use Symfony\Component\Console\Output\ConsoleOutput;

use CloudApp\API as CloudApp;

/**
 * Class CloudAppClient
 *
 * @package Dizda\CloudBackupBundle\Clients
 * @author  Jonathan Dizdarevic <dizda@dizda.fr>
 */
class CloudAppClient
{
    private $output;
    private $user;
    private $password;

    /**
     * @param string $user
     * @param string $password
     */
    public function __construct($user, $password)
    {
        $this->output     = new ConsoleOutput();
        $this->user       = $user;
        $this->password   = $password;
    }


    public function upload($archive)
    {
        $this->output->write('- <comment>Uploading to CloudApp...</comment>');

        $cloudapp = new CloudApp($this->user, $this->password);
        $cloudapp->addFile($archive);

        $this->output->writeln('<info>OK</info>');
    }

}