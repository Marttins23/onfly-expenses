# Gerenciador de Despesas Onfly

## Descrição
Esta aplicação é uma API RESTful construída em Laravel para gerenciar despesas associadas a usuários e uma interface de usuário em Vue.JS 3 (Framework Quasar) para consumir essa API. A aplicação permite criar, listar, atualizar e deletar despesas, seguindo os princípios RESTful. A aplicação conta com testes de unidade. Outros detalhes técnicos foram fornecidos no detalhamento do desafio.

## Tecnologias Utilizadas

- **Backend**: Laravel 10, PHP 8.3, MySQL
- **Frontend**: Vue.JS 3 e Quasar (Framework)
- **Testes**: PHPUnit, Mockery

## Requisitos
- PHP >= 8.3
- Composer
- Node.js >= 18
- MySQL
- NPM

## Instalação

### Clonar o Repositório
```bash
git clone https://github.com/Marttins23/onfly-expenses.git
cd onfly-expenses
```
## Backend - Laravel

### Navegar até a pasta 'backend':
```bash
cd backend
```

### Instalar as dependências do Laravel:
```bash
composer install
```

### Configurar o ambiente:
```bash
cp .env.example .env
php artisan key:generate
```

### Configurar o banco de dados no arquivo .env:
Após instalar e configurar o MySQL:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=port
DB_DATABASE=databse_name
DB_USERNAME=databse_user
DB_PASSWORD=database_password
```
### Rodar as migrations:
```bash
php artisan migrate
```

### Iniciar o servidor:
```bash
php artisan serve
```
## Frontend - Vue.JS

### Navegar até a pasta 'frontend':
```bash
cd frontend
```

### Instalar as dependências:
```bash
npm install
```

### Iniciar o servidor:
```bash
npx quasar dev
```
ou 
```bash
quasar dev
```
se tiver o CLI do Quasar instalado.

## Uso da aplicação

### Endpoints da API:
 - **POST /api/login - Realizar o login**
   Exemplo de corpo da requisição:
    ```bash
    {
        "e-mail": "teste@gmail.com",
        "password": "test123",
    }
    ```
 - **POST /api/register - Registrar um novo usuário**
   Exemplo de corpo da requisição:
    ```bash
    {
        "name": "João da Silva",
        "e-mail": "teste@gmail.com",
        "password": "test123",
        "password_confirmation": "test123"
    }
    ```
 - **GET /api/users/{id}/expenses - Listar todas as despesas de um usuário**
 - **POST /api/users/{id}/expenses - Criar uma nova despesa para um usuário** 
    Exemplo de corpo da requisição:
    ```bash
    {
         "description": "Teste 56",
         "value": "720.00",
         "date": "2024-10-04"
    }
    ```
 - **PUT /api/expenses/{id} - Atualizar uma despesa**
    Exemplo de corpo da requisição:
    ```bash
    {
        "description": "Teste 56",
         "value": "710.00",
         "date": "2024-10-04"
    }
    ```
 - **DELETE /api/expenses/{id} - Deletar uma despesa**

 ### Interface de Usuário (React):

 - *Acesse a interface em http://localhost:9000/login para logar ou http://localhost:9000/register para criar um usuário e já pode começar a utilizar a aplicação.*

## Testes

### Para executar os testes unitários e de integração:
```bash
php artisan test
```
