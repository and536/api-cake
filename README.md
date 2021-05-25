## PreRequisitos

Ter instalado no Windows ou Linux o Apache, o PHP > 7 e o MySQL >= 5.3

## Installation

1. Faça o git clone do projeto. Ex.: `git clone https://github.com/and536/api-cake.git`
2. Entre no diretório do projeto e rode: `composer install`
3. Rode no terminal esse comando : `bin/cake server`
4. Abra no navegador o endereço que aparecer no seu terminal. Ex.: `http://localhost:8765`
   Se aparecer a tela de apresentação do CakePHP 4 a api já está funcional no seu ambiente.

## Configuration

1. Renomeie o arquivo `config/app_local.example.php` para `config/app_local.php`
2. No seu banco MySQL crie dois databases com os nomes respectivamente: `api-cake` e `api-cake-tests`
3. No arquivo `config/app_local.php` configure seu banco de dados com usuario, senha, etc. Não esqueça do Datasources de teste.

## Testes
Os Teste de rotas foi feito no Postman e tem o arquivo da collection no repositorio. Nome do arquivo: `API-Cake.postman_collection.json`

Os Testes Unitarios da Api estão no PHPUnit e dentro de cada plugin que vou tratar como Apis.

1. Rode dentro do diretório da API: `vendor/bin/phpunit plugins/ApiClientes`, `vendor/bin/phpunit plugins/ApiProdutos` e `vendor/bin/phpunit plugins/ApiPedidos`
 