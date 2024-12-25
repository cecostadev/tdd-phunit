<?php

namespace Alura\Leilao\Tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function test_leilao_recebe_lances(): void
    {

        $leilao = new Leilao('Gol 1995 - Usado');

        $leilao->recebeLance(new Lance(new Usuario('Carlos'), 5000));
        $leilao->recebeLance(new Lance(new Usuario('Henrique'), 10000));
        $leilao->recebeLance(new Lance(new Usuario('José'), 20000));

        self::assertCount(3, $leilao->getLances());
        self::assertEquals(20000, $leilao->getLances()[2]->getValor());
    }

    public function test_leilao_nao_recebe_lance_duplicado(): void
    {
        $leilao = new Leilao('Gol 1995 - Usado');

        $usuarioUm  = new Usuario('Carlos');
        $usuarioDois = new Usuario('Henrique');

        $leilao->recebeLance(new Lance($usuarioUm, 5000));
        $leilao->recebeLance(new Lance($usuarioDois, 10000));
        $leilao->recebeLance(new Lance($usuarioDois, 20000));

        self::assertCount(2, $leilao->getLances());
        self::assertEquals(10000, $leilao->getLances()[1]->getValor());
    }

    public function test_leilao_tem_limites_lance_usuario(): void
    {
        $leilao = new Leilao('Gol 1995 - Usado');

        $usuarioUm  = new Usuario('Carlos');
        $usuarioDois = new Usuario('Henrique');
        $usuarioTres = new Usuario('Joaquim');

        $leilao->recebeLance(new Lance($usuarioUm, 5000));
        $leilao->recebeLance(new Lance($usuarioDois, 10000));
        $leilao->recebeLance(new Lance($usuarioUm, 20000));
        $leilao->recebeLance(new Lance($usuarioDois, 30000));
        $leilao->recebeLance(new Lance($usuarioUm, 40000));
        $leilao->recebeLance(new Lance($usuarioDois, 45000));
        $leilao->recebeLance(new Lance($usuarioUm, 60000));
        $leilao->recebeLance(new Lance($usuarioDois, 45000));
        $leilao->recebeLance(new Lance($usuarioTres, 45000));

        self::assertCount(7, $leilao->getLances());
    }
}