<?php

namespace WebmanAuth\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use WebmanAuth\facade\Str;


class AuthKeyCommand extends Command
{
    protected static string $defaultName = 'auth:key';
    protected static string $defaultDescription = 'auth key';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Name description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln('Generate jwtKey Start');
        $key = Str::random(64);
        file_put_contents(base_path()."/config/plugin/jizhi/auth/app.php", str_replace(
            "'access_secret_key' => '".config('plugin.jizhi.auth.app.jwt.access_secret_key')."'",
            "'access_secret_key' => '".$key."'",
            file_get_contents(base_path()."/config/plugin/jizhi/auth/app.php")
        ));
        file_put_contents(base_path()."/config/plugin/jizhi/auth/app.php", str_replace(
            "'refresh_secret_key' => '".config('plugin.jizhi.auth.app.jwt.refresh_secret_key')."'",
            "'refresh_secret_key' => '".$key."'",
            file_get_contents(base_path()."/config/plugin/jizhi/auth/app.php")
        ));
        $output->writeln('Generate jwtKey End'.$key);
        return self::SUCCESS;
    }

}
