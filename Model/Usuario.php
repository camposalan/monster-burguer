<?php

class Usuario
{
    private int $id;
    private string $email;
    private string $senha;

    /**
     * @param int $id
     * @param string $email
     * @param string $senha
     */
    public function __construct(int $id, string $email, string $senha)
    {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }




}