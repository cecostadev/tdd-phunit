<?php

namespace Alura\Leilao\Model;

use Alura\Leilao\Model\Usuario;

class Leilao
{   
    const NUM_LANCES = 3;
    private $lances;
    private $descricao;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance(Lance $lance)
    {   
        $ultimoLance = end($this->lances);

        if($ultimoLance && !$this->permiteEfetuarLance($ultimoLance->getUsuario(), $lance->getUsuario())) {
            return;
        }
        
        $lance->getUsuario()->aumentaNumeroLances();

        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    private function permiteEfetuarLance(
        Usuario $usuarioLanceAnterior, 
        Usuario $usuarioLanceAtual
    ): bool
    {
        if($usuarioLanceAnterior == $usuarioLanceAtual || $usuarioLanceAtual->getNumeroLances() >= self::NUM_LANCES) {
            return false;
        }

        return true;
    }
}
