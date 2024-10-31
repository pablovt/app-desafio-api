# Projeto - Desafio - API

Instalador e ambiente de execução baseado em [Docker](https://www.docker.com/) para o framework web [Symfony](https://symfony.com), com [FrankenPHP](https://frankenphp.dev) e [Caddy](https://caddyserver.com/) integrados!


## Introdução

Iniciando:

#### 1º Passo:
Execute `docker compose build --no-cache` para compilar imagens novas.

#### 2º Passo:
Execute `docker compose up --pull always -d --wait` para configurar e iniciar um novo projeto Symfony.

#### 3º Passo:
Abra `https://localhost` no seu navegador favorito e [aceite o certificado TLS](https://stackoverflow.com/a/15076602/1352334) gerado automaticamente.

#### 4º Passo:
Execute `docker compose down --remove-orphans` para parar os contêineres Docker.

Para saber mais sobre as configurações e funcionalidades que dispõe Symfony Docker, pode ser acessado o [GitHub dunglas/symfony-docker](https://github.com/dunglas/symfony-docker).


## Resumo do projeto

### `- Framework Backend Symfony 7`

O Symfony 7 foi utilizado como base para o desenvolvimento do backend, o que garante uma estrutura sólida e bem organizada para a criação de APIs. \

### `- Autenticação com JWT`

O projeto utiliza JSON Web Token (JWT) para autenticação. Esse método de autenticação permite que o backend gere um token único para cada usuário autenticado. 

### `- Consulta à API HG Brasil`

A consulta à API da HG Brasil trazendo dados climáticos em tempo real. \
Esta integração incluí chamadas para buscar dados (como temperatura, umidade, condição do tempo) que são disponibilizados na forma de API.

### `- CRUD de Livros`

O backend implementa operações de CRUD (Create, Read, Update, Delete) para gerenciar informações sobre livros.