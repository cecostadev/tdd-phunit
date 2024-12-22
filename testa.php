<?php

require 'vendor/autoload.php';

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

$leilao = new Leilao('Computador de Bordo Aeronave');

$usuario1 = new Usuario('Carlos');
$usuario2 = new Usuario('Henrique');

$leilao->recebeLance(new Lance($usuario1, '20000'));
$leilao->recebeLance(new Lance($usuario2, '45000'));

$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);
echo $leiloeiro->getMaiorValor();