<?php

namespace App\Framework\Models;
use App\Framework\Repository\UserRepository;

class UserModel extends Model {
    const TABLE = 'usuario';

    private $id;
    private $email;
    private $password;

    public function __construct() {
        $repository = new UserRepository();
        parent::getInstance()->setRepository($repository);
    }

    public function getUser(string $by): object {
        return self::getBy($by);
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function getId(): int {
        return $this->id;
    }

    public function getSenha(): string {
        return $this->password;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function setSenha(string $password): void {
        $this->password = $password;
    }
}