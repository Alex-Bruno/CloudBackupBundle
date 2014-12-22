<?php
namespace Dizda\CloudBackupBundle\Clients;

use Symfony\Component\Console\Output\ConsoleOutput;

use CloudApp\API as CloudApp;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class CloudAppClient
 *
 * @package Dizda\CloudBackupBundle\Clients
 * @author  Jonathan Dizdarevic <dizda@dizda.fr>
 */
class CloudAppClient implements ClientInterface
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
        $this->output->write('- <comment>Uploading to CloudApp... </comment>');
        $cloudapp = new CloudApp($this->user, $this->password);
        if(is_array($archive)){
            $this->output->writeln("");
            foreach($archive as $file /* @var $file SplFileInfo*/){
                $this->output->write(sprintf('----- <comment>Uploading file: %s... </comment>', $file->getFilename()));
                $cloudapp->addFile($file);
                $this->output->writeln('<info>OK</info>');
            }
        }
        else{
            $cloudapp->addFile($archive);
            $this->output->writeln('<info>OK</info>');
        }

    }

}