# Leilão - Projeto de Avaliação

Este é um projeto simples que simula um sistema de leilão, onde é possível adicionar lances e avaliar o maior e menor lance de um leilão. O projeto inclui testes unitários utilizando o PHPUnit para garantir o correto funcionamento das funcionalidades principais.

## Funcionalidades

-   Criar um leilão com um item específico.
    
-   Adicionar lances ao leilão.
    
-   Avaliar o maior e o menor lance.
    
-   Validar cenários de exceção, como:
    
    -   Não é possível avaliar um leilão sem lances.
        

## Tecnologias Utilizadas

-   **PHP**: Linguagem principal do projeto.
    
-   **PHPUnit**: Framework de testes utilizado para garantir a qualidade do código.
    

## Como Executar o Projeto

1.  Clone o repositório:
    
    ```
    git clone https://github.com/cecostadev/tdd-phunit
    ```
    
2.  Acesse a pasta do projeto:
    
    ```
    cd tdd-phpunit
    ```
    
3.  Instale as dependências:
    
    ```
    composer install
    ```
    
4.  Execute os testes:
    
    ```
    ./vendor/bin/phpunit tests
    ```
    

## Estrutura do Projeto

```
tdd-phpunit/
├── src/Model
│   ├── Leilao.php
│   ├── Lance.php
│   ├── Usuario.php
├── src/Service
|   ├── AvaliadorService.php
├── tests/
│   ├── LeilaoTest.php
│   ├── AvaliadorTest.php
├── composer.json
├── README.md
```

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma _issue_ ou enviar um _pull request_.

## Licença

Este projeto está licenciado sob a Licença MIT.

## Certificado

https://drive.google.com/file/d/11JIbh7tsWwu_ajBmYp278Y1t1Qt8Goan/view?usp=sharing
