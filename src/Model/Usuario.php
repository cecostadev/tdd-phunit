<?php

namespace Alura\Leilao\Model;

class Usuario
{
    /** @var string */
    private $nome;
    private $numeroLances;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
        $this->numeroLances = 0;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getNumeroLances(): int
    {
        return $this->numeroLances;
    }

    public function aumentaNumeroLances(): void
    {
        $this->numeroLances++;
    }
}
