# Notes - Projeto de Aprendizado Laravel

![Notes Logo](public/assets/images/logo.png)

## Sobre o Projeto

Notes é uma aplicação web simples desenvolvida para fins de aprendizado do framework Laravel. O projeto consiste em um sistema de notas pessoais onde os usuários podem criar, visualizar, editar e excluir suas anotações após autenticação.

## Funcionalidades

- **Sistema de Autenticação**: Login e logout de usuários
- **Gerenciamento de Notas**: 
  - Visualização de todas as notas do usuário
  - Criação de novas notas
  - Edição de notas existentes
  - Exclusão de notas

## Tecnologias Utilizadas

- **[Laravel](https://laravel.com/)**: Framework PHP para desenvolvimento web
- **[Bootstrap](https://getbootstrap.com/)**: Framework CSS para design responsivo
- **[Font Awesome](https://fontawesome.com/)**: Biblioteca de ícones
- **MySQL**: Banco de dados relacional (configurável para SQLite durante desenvolvimento)

## Instalação

### Pré-requisitos

- PHP >= 8.1
- Composer
- Node.js e NPM
- Servidor de banco de dados (MySQL, PostgreSQL, SQLite)

### Passo a Passo

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/notes.git
cd notes
```

2. Instale as dependências do PHP:
```bash
composer install
```

3. Copie o arquivo de ambiente:
```bash
cp .env.example .env
```

4. Configure o arquivo `.env` com suas informações de banco de dados e outras configurações necessárias

5. Gere a chave da aplicação:
```bash
php artisan key:generate
```

6. Execute as migrações do banco de dados:
```bash
php artisan migrate
```

7. Inicie o servidor de desenvolvimento:
```bash
php artisan serve
```

8. Acesse o projeto em `http://localhost:8000`

## Estrutura do Projeto

### Controllers

- **AuthController**: Gerencia autenticação (login/logout)
- **MainController**: Controla as funcionalidades principais da aplicação

### Middlewares

- **CheckIsLogged**: Verifica se o usuário está autenticado
- **CheckIsNotLogged**: Verifica se o usuário não está autenticado (para páginas de login)

### Views

- **login.blade.php**: Página de login
- **home.blade.php**: Página principal com listagem de notas
- **layouts/main_layout.blade.php**: Layout principal da aplicação

## Rotas

- **GET / :** Página inicial (requer autenticação)
- **GET /login :** Página de login
- **POST /loginSubmit :** Processamento do formulário de login
- **GET /logout :** Realiza o logout do usuário
- **GET /new :** Página para criar uma nova nota

## Aprendizados e Conceitos Explorados

Este projeto foi desenvolvido para explorar os seguintes conceitos do Laravel:

- Sistema de rotas
- Controllers e Models
- Blade templating engine
- Middleware para controle de acesso
- Validação de formulários
- Autenticação de usuários
- Eloquent ORM para interação com banco de dados
- Sessions

## Próximos Passos

- Implementar sistema completo de notas (criar, editar, excluir)
- Adicionar sistema de registro de usuários
- Implementar perfil de usuário
- Adicionar categorias para as notas
- Implementar sistema de busca

## Contribuições

Este é um projeto de aprendizado pessoal, mas sugestões e melhorias são bem-vindas através de pull requests!

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

Desenvolvido como projeto de aprendizado por [Seu Nome] - &copy; 2025
