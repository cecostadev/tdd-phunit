<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{

    public function test_maior_crescente()
    {
        $leilao = new Leilao('Computador de Bordo Aeronave');
        $valorEsperado = 45000;

        $usuario1 = new Usuario('Carlos');
        $usuario2 = new Usuario('Henrique');

        $leilao->recebeLance(new Lance($usuario1, '20000'));
        $leilao->recebeLance(new Lance($usuario2, '45000'));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        self::assertEquals($leiloeiro->getMaiorValor(), 45000);
    }

    public function test_maior_decrescente()
    {
        $leilao = new Leilao('Computador de Bordo Aeronave');
        $valorEsperado = 45000;

        $usuario1 = new Usuario('Carlos');
        $usuario2 = new Usuario('Henrique');

        $leilao->recebeLance(new Lance($usuario2, '45000'));
        $leilao->recebeLance(new Lance($usuario1, '20000'));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        self::assertEquals($leiloeiro->getMaiorValor(), 45000);
    }

    public function test_menor_crescente()
    {
        $leilao = new Leilao('Computador de Bordo Aeronave');
        $valorEsperado = 45000;

        $usuario1 = new Usuario('Carlos');
        $usuario2 = new Usuario('Henrique');

        $leilao->recebeLance(new Lance($usuario1, '20000'));
        $leilao->recebeLance(new Lance($usuario2, '45000'));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        self::assertEquals($leiloeiro->getMenorValor(), 20000);
    }
}