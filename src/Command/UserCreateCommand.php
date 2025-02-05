<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Random\RandomException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:user:create',
    description: 'Create a new user',
)]
class UserCreateCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository $userRepository,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $userName = $io->ask('Username');
        $user = $this->userRepository->findOneBy(['username' => $userName]);
        $existing = null !== $user;
        if ($existing) {
            $io->warning('Editing existing user!');
        } else {
            $user = new User();
            $user->setUsername($userName);
        }

        $password = $io->askHidden('Password (leave blank for random password)');
        $random = empty(trim($password ?? ''));
        if ($random) {
            try {
                $password = bin2hex(random_bytes(32));
            } catch (RandomException $e) {
                $io->error($e->getMessage());
            }
        }

        $admin = $io->confirm('Is admin?', \in_array('ROLE_ADMIN', $user->getRoles(), true));
        if ($admin) {
            $user->setRoles(['ROLE_ADMIN']);
        }

        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                $password
            )
        );
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        if ($random) {
            if ($io->confirm('Show password?', $admin)) {
                $io->writeln($password);
            }
        }

        return Command::SUCCESS;
    }
}
