# ApiMyContacts

# API RESTful em PHP com Silex

## Descrição do Projeto

Este projeto é uma API RESTful desenvolvida em PHP utilizando o microframework **Silex**. A API foi projetada para gerenciar dados de contatos e pessoas, oferecendo operações de criação, leitura, atualização e exclusão (CRUD). A arquitetura segue o padrão **MVC** para garantir uma organização eficiente e escalabilidade.

---

## Principais Funcionalidades

- API RESTful para gerenciar pessoas e contatos.
- Persistência de dados utilizando MySQL com **Doctrine DBAL**.
- Controle de migrations com o pacote **Phinx**.
- Documentação das rotas e parâmetros utilizando **Swagger UI**.
- Organização do código baseada em boas práticas de **MVC**.

---

## Stack Utilizada

- **PHP 7.4+**
- **Silex** (Framework Micro PHP)
- **MySQL** (Banco de Dados Relacional)
- **Doctrine DBAL** (Para manipulação de banco de dados)
- **Phinx** (Controle de Migrations)
- **Swagger UI** (Documentação e Teste Interativo da API)

---

## Configuração do Ambiente

### 1. Clonar o Repositório

```bash
git clone <url-do-repositorio>
cd <nome-do-repositorio>
```

### 2. Instalar Dependências

Certifique-se de que o **Composer** está instalado. Execute:

```bash
composer install
```

### 3. Configurar o Banco de Dados

1. Crie um banco de dados MySQL.
2. Configure as credenciais no arquivo `config/database.php`:

```php
return [
    'dbname' => 'nome_do_banco',
    'user' => 'usuario',
    'password' => 'senha',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
```

### 4. Executar Migrations

Para criar as tabelas no banco de dados, utilize o Phinx:

-> Para criar migration:
```bash
vendor/bin/phinx create Create{....}Table
```
-> Para rodar migration:
```bash
vendor/bin/phinx migrate
```

---

## Como Executar o Projeto

### 1. Iniciar o Servidor Local

PARA start da aplicação!
Use o servidor embutido do PHP:

```bash
php -S localhost:8000 -t public
```

### 2. Testar no Navegador

Abra o navegador e acesse:

- **API Health Check:** [http://localhost:8000/](http://localhost:8000/)
- **Documentação da API:** [http://localhost:8000/swagger-ui/index.html](http://localhost:8000/swagger-ui/index.html)

---

## Documentação das Rotas

A documentação completa das rotas da API está disponível via **Swagger UI**.

### Exemplo de Rotas

- **GET /api/person**: Lista todas as pessoas.
- **POST /api/person**: Cria uma nova pessoa.
- **GET /api/person/{id}**: Busca uma pessoa por ID.
- **PUT /api/person/{id}**: Atualiza uma pessoa por ID.
- **DELETE /api/person/{id}**: Exclui uma pessoa por ID.

---

## Organização do Código

A API segue o padrão MVC para garantir uma organização clara:

```
api-silex/
├── config/
│   ├── config.php        # Configurações gerais
│   ├── database.php      # Configurações do banco de dados
├── public/
│   └── index.php         # Arquivo de entrada
├── src/
│   ├── Controllers/      # Controladores
│   ├── Models/           # Modelos
│   └── Services/         # Serviços (opcional)
├── migrations/           # Arquivos de migrations do Phinx
├── composer.json
└── phinx.php             # Configuração do Phinx
```



`README.md`, para qualquer desenvolvedor, capaz de configurar, executar e contribuir para o projeto de forma eficiente. 🚀
