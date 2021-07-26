# Desafio Técnico PHP Portabilis

## Instalação

Clone o projeto
```bash
git clone git@github.com:rafaeldimas/desafio-tecnico-php-portabilis.git
```

Instala as dependencias
```bash
composer install
```

Caso não tenha o arquivo .env execute esse comando para utilizar com o padrão.
```bash
cp .env.example .env
```

Caso queira utilizar o Sail (subir os containers para executar a aplicação)
```bash
sail up -d
```

## Usage

Envie esse body para o end-point POST: "api/token/create" para conseguir o token de autenticação.
```json
{
    "email": "admin@admin.com", 
    "password": "admin"
}
```

Envie esse body e com um header Authorization com o token Bearer recebido da primeira requisição, para o end-point POST: "api/users" cadastrar um novo colaborador.
```json
{
    "name": "teste", 
    "email": "teste@teste.com", 
    "password": "teste", 
    "role": "Admin"
}
```

Envie esse body e com um header Authorization com o token Bearer recebido da primeira requisição, para o end-point PUT: "api/users" cadastrar um novo colaborador.
```json
{
    "active": false
}
```
