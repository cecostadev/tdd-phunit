<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;

class Avaliador
{   

    public float $maiorValor;
    public float $menorValor;

    public function avalia(Leilao $leilao): void
    {
        $lances = $leilao->getLances();

        $maiorLance = array_reduce($lances, function($primeiro, $lance) { 
            return ($primeiro === null || $lance->getValor() > $primeiro->getValor()) ? $lance : $primeiro; 
        }, null);

        $menorLance = array_reduce($lances, function($primeiro, $lance) { 
            return ($primeiro === null || $lance->getValor() < $primeiro->getValor()) ? $lance : $primeiro; 
        }, null);

        $this->maiorValor = $maiorLance->getValor();
        $this->menorValor = $menorLance->getValor();
    }

    public function getMaioresValores(Leilao $leilao):array
    {
        $lances = $leilao->getLances();

        usort($lances, function($a, $b) {
            return $b->getValor() <=> $a->getValor();
        });

        return array_slice($lances, 0, 4);
    }

    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }
}