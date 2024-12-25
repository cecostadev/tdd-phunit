<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{   

    private Avaliador $leiloeiro;

    public function setUp():void
    {
        $this->leiloeiro = new Avaliador();
    }

    public function test_leilao_vazio()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar leilão vazio');
    
        $leilao = new Leilao('Apartamento Duplex - RJ');
        $this->leiloeiro->avalia($leilao);
    }

    /**
    * @dataProvider criaLeiLaoCrescente
    */
    public function test_maior_crescente(Leilao $leilao)
    {   
        
        $this->leiloeiro->avalia($leilao);

        self::assertEquals($this->leiloeiro->getMaiorValor(), 45000);
    }

    /**
    * @dataProvider criaLeiLaoDecrescente
    */
    public function test_maior_decrescente(Leilao $leilao)
    {
        
        $this->leiloeiro->avalia($leilao);

        self::assertEquals($this->leiloeiro->getMaiorValor(), 45000);
    }

    /**
    * @dataProvider criaLeiLaoCrescente
    */
    public function test_menor_crescente(Leilao $leilao)
    {
        
        $this->leiloeiro->avalia($leilao);

        self::assertEquals($this->leiloeiro->getMenorValor(), 20000);
    }

    /**
    * @dataProvider criaLeiLaoCrescente
    * @dataProvider criaLeiLaoDecrescente
    */
    public function test_maiores_valores(Leilao $leilao)
    {
        
        $maioresLances = $this->leiloeiro->getMaioresValores($leilao);

        $maiorValor = $maioresLances[0]->getValor();

        self::assertCount(3, $maioresLances);
        self::assertEquals(45000, $maiorValor);
        self::assertEquals(20000, $maioresLances[2]->getValor());
    }
    
    /**
    * @dataProvider criaLeilaoDoisLances
    */
    public function test_dois_lances(Leilao $leilao)
    {

        $maioresLances = $this->leiloeiro->getMaioresValores($leilao);

        $maiorValor = $maioresLances[0]->getValor();

        self::assertCount(2, $maioresLances);
        self::assertEquals(45000, $maiorValor);
    }

    public static function criaLeiLaoCrescente(): array
    {
        $leilao = new Leilao('Computador de Bordo Aeronave');

        $usuario1 = new Usuario('Carlos');
        $usuario2 = new Usuario('Henrique');
        $usuario3 = new Usuario('João');

        $leilao->recebeLance(new Lance($usuario1, '20000'));
        $leilao->recebeLance(new Lance($usuario3, '36000'));
        $leilao->recebeLance(new Lance($usuario2, '45000'));

        return [
            'crescente' => [$leilao],
        ];
    }

    public static function  criaLeiLaoDecrescente()
    {
        $leilao = new Leilao('Computador de Bordo Aeronave');

        $usuario1 = new Usuario('Carlos');
        $usuario2 = new Usuario('Henrique');
        $usuario3 = new Usuario('João');

        $leilao->recebeLance(new Lance($usuario2, '45000'));
        $leilao->recebeLance(new Lance($usuario3, '36000'));
        $leilao->recebeLance(new Lance($usuario1, '20000'));

        return [
            'decrescente' => [$leilao],
        ];
    }

    public static function criaLeilaoDoisLances()
    {
        $leilao = new Leilao('Computador de Bordo Aeronave');

        $usuario1 = new Usuario('Carlos');
        $usuario2 = new Usuario('Henrique');

        $leilao->recebeLance(new Lance($usuario1, '45000'));
        $leilao->recebeLance(new Lance($usuario2, '36000'));

        return [
            'aleatorio' => [$leilao],
        ];
    }
}