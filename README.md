# GestPeople - Backend (API de Gestão de Pessoal)

## 📋 Descrição

**GestPeople** é um sistema de gestão de recursos humanos (RH) desenvolvido com Laravel 11, fornecendo uma API RESTful completa para gerenciar funcionários, departamentos, funções, desempenho, presenças e suspensões. O backend é integrado com um frontend em React.js que consome esta API.

Este repositório contém apenas o **backend** do projeto. O frontend está disponível em repositório separado.

## ✨ Funcionalidades Principais

- 🔐 **Autenticação e Autorização**: Autenticação com Sanctum, controle de acesso baseado em roles
- 👥 **Gestão de Utilizadores**: Criar, listar, atualizar e gerir utilizadores
- 🏢 **Departamentos**: CRUD completo de departamentos
- 💼 **Funções**: Gestão de funções e cargos
- 📊 **Desempenho**: Acompanhamento do desempenho de funcionários
- 📅 **Presenças**: Registo de presenças e assiduidade
- 🚫 **Suspensões**: Gestão de suspensões de funcionários
- 🗨 **Chat**: Conversa interna entre os funcioários 
- 📈 **Relatórios**: Estatísticas e contadores (utilizadores por departamento, funções, etc.)

## 🛠️ Tecnologias Utilizadas

- **Laravel 12** - Framework PHP
- **PHP 8.2+** - Linguagem de programação
- **MySQL** - Base de dados
- **Laravel Sanctum** - Autenticação de API
- **Composer** - Gestor de dependências PHP
- **Vite** - Build tool (para assets frontend)

## 📦 Pré-requisitos

- PHP 8.2 ou superior
- Composer (gestor de dependências PHP)
- MySQL 5.7+
- Node.js 16+ (para Vite)
- npm ou yarn (gestor de pacotes npm)

## 🚀 Instalação

### 1. Clonar o repositório

```bash
git clone https://github.com/lionelandre01-programmer/gestpeople-backend.git
cd gestpeople-backend
```

### 2. Instalar dependências PHP

```bash
composer install
```

### 3. Instalar dependências npm (para Vite)

```bash
npm install
```

### 4. Configurar variáveis de ambiente

Copie o arquivo `.env.example` e configure os dados da sua base de dados:

```bash
cp .env.example .env
```

Edite o arquivo `.env` e configure:
- `APP_NAME` - Nome da aplicação
- `APP_URL` - URL do seu servidor (ex: http://localhost:8000)
- `DB_CONNECTION` - mysql
- `DB_HOST` - localhost (ou seu host)
- `DB_PORT` - 3306
- `DB_DATABASE` - gestpeople
- `DB_USERNAME` - seu usuário MySQL
- `DB_PASSWORD` - sua senha MySQL
- `SANCTUM_STATEFUL_DOMAINS` - Domínios do frontend (ex: localhost:5173)

### 5. Gerar chave da aplicação

```bash
php artisan key:generate
```

### 6. Executar migrações

```bash
php artisan migrate
```

### 7. (Opcional) Executar seeders

```bash
php artisan db:seed
```

## 📖 Uso / Rodando o Servidor

### Modo desenvolvimento com Laragon

Se estiver usando **Laragon**, o servidor já está configurado. Aceda a:
```
http://127.0.0.1:8000
```

### Modo desenvolvimento com artisan

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

O servidor estará disponível em: `http://127.0.0.1:8000`

### Compilar assets (Vite)

```bash
# Desenvolvimento (com hot reload)
npm run dev

# Produção
npm run build
```

## 📁 Estrutura do Projeto

```
GestPeople/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controladores da API
│   │   └── Requests/           # Form requests e validação
│   ├── Models/                 # Modelos Eloquent
│   ├── Policies/               # Políticas de autorização
│   ├── Services/               # Lógica de negócio
│   └── Providers/              # Service providers
├── bootstrap/                  # Ficheiros de bootstrap
├── config/                     # Ficheiros de configuração
├── database/
│   ├── factories/              # Model factories para testes
│   ├── migrations/             # Migrações de BD
│   └── seeders/                # Seeders da BD
├── public/                     # Directório público (index.php)
├── resources/
│   ├── css/                    # Estilos CSS
│   ├── js/                     # Scripts JavaScript
│   └── views/                  # Vistas Blade (se houver)
├── routes/
│   ├── api.php                 # Rotas da API
│   ├── web.php                 # Rotas da aplicação web
│   └── console.php             # Comandos Artisan
├── storage/                    # Ficheiros gerados (logs, cache, etc.)
├── tests/                      # Testes automatizados
├── vendor/                     # Dependências Composer
├── .env.example                # Exemplo de variáveis de ambiente
├── composer.json               # Dependências PHP
├── package.json                # Dependências npm
├── vite.config.js              # Configuração Vite
└── phpunit.xml                 # Configuração PHPUnit
```

## 📡 API Endpoints

### Autenticação

| Método | Endpoint | Descrição | Autenticação |
|--------|----------|-----------|--------------|
| POST | `/api/login` | Fazer login | Não |
| POST | `/api/user/create` | Registar novo utilizador | Não |
| POST | `/api/logout` | Fazer logout | Sim (Sanctum) |
| GET | `/api/auth/get` | Obter dados do utilizador autenticado | Sim (Sanctum) |

### Utilizadores

| Método | Endpoint | Descrição | Autenticação |
|--------|----------|-----------|--------------|
| GET | `/api/user/all` | Listar todos os utilizadores | Sim |
| GET | `/api/user/bests` | Listar melhores utilizadores | Sim |
| GET | `/api/user/suspended/count` | Contar utilizadores suspensos | Sim |
| GET | `/api/user/active/count` | Contar utilizadores ativos | Sim |
| PUT | `/api/user/update` | Atualizar dados do utilizador | Sim |

### Departamentos

| Método | Endpoint | Descrição | Autenticação |
|--------|----------|-----------|--------------|
| GET | `/api/departamento/get` | Listar departamentos | Não |
| POST | `/api/departamento/create` | Criar departamento | Sim |
| GET | `/api/departamento/users/count` | Contar utilizadores por departamento | Sim |

### Funções

| Método | Endpoint | Descrição | Autenticação |
|--------|----------|-----------|--------------|
| GET | `/api/funcao/get` | Listar funções | Não |
| POST | `/api/funcao/create` | Criar função | Sim |
| GET | `/api/funcao/users/count` | Contar utilizadores por função | Sim |
| GET | `/api/funcao/count` | Contar total de funções | Sim |

Veja `routes/api.php` para a listagem completa de endpoints.

## 🔒 Configuração CORS

A configuração CORS está em `config/cors.php`. Para o desenvolvimento com o frontend em `http://localhost:5173`, já está configurado. Para alterar:

```php
'allowed_origins' => [
    'http://localhost:5173',
    'http://127.0.0.1:5173',
    // Adicione outras origens conforme necessário
],
```

**Nota**: Para produção, configure apenas os domínios permitidos, nunca use `*` para segurança.

## ✅ Testes

Executar testes automatizados:

```bash
php artisan test
```

Ou com PHPUnit diretamente:

```bash
./vendor/bin/phpunit
```

## 🔑 Variáveis de Ambiente Importantes

```env
APP_NAME=GestPeople
APP_URL=http://127.0.0.1:8000
APP_DEBUG=true (apenas em desenvolvimento)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestpeople
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost:5173,127.0.0.1:5173
SESSION_DOMAIN=.localhost
```

## 📝 Regras de Desenvolvimento

- Siga o padrão PSR-12 para código PHP
- Adicione testes para novas funcionalidades
- Use migrations para alterações na base de dados
- Documente endpoints com comentários
- Faça commits com mensagens claras e descritivas

## 🐛 Troubleshooting

### Erro CORS
Se receber error de CORS, certifique-se de:
1. Limpar cache: `php artisan config:clear`
2. Reiniciar o servidor
3. Verificar que `SANCTUM_STATEFUL_DOMAINS` está configurado corretamente

### Erro de conexão à BD
Verifique as credenciais de conexão em `.env` e que o servidor MySQL está em execução.

### Permissions denied
Se tiver erros de permissão em `storage/`, execute:
```bash
chmod -R 775 storage/ bootstrap/cache/
```

## 🔗 Repositórios Relacionados

- **Frontend (React.js)**: [gestpeople-frontend] https://github.com/lionelandre01-programmer/gestpeople-frontend.git

## 📄 Licença

Este projeto está sob a licença [MIT](LICENSE).

## 👥 Autor

Desenvolvido Por Lionel Cristóvão André.

---

**Status do Projeto**: Em desenvolvimento 🚧

**Última atualização**: Maio de 2026
