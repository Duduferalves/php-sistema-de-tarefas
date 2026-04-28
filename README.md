# Gerenciador de Tarefas — PHP & PDO

Sistema web para gerenciamento de tarefas (CRUD completo) construído com PHP e MySQL. Este projeto foi desenvolvido como requisito avaliativo (A2) para a disciplina de Desenvolvimento de Sistemas, aplicando conceitos de persistência de dados, controle de sessão e interface responsiva.

---

## Índice

1. Stack Tecnológico
2. Funcionalidades
3. Como Executar o Projeto Localmente

---

## 1. Stack Tecnológico

| Camada | Tecnologia |
|---|---|
| **Backend** | PHP (Vanilla) |
| **Banco de Dados** | MySQL / MariaDB via PDO |
| **Frontend** | HTML5, CSS3, Bootstrap 5 (CDN) |
| **Arquitetura** | Monolito MVC simplificado — lógica transacional e de apresentação acopladas por requisito do projeto |

---

## 2. Funcionalidades

### Autenticação

Login e Logout com controle estrito de sessão via `$_SESSION`.

### Isolamento de Dados

Usuários só possuem acesso às suas próprias tarefas — prevenção de IDOR (Insecure Direct Object Reference).

### CRUD de Tarefas

| Operação | Descrição |
|---|---|
| **Create** | Adição de novas tarefas com título e descrição |
| **Read** | Listagem dinâmica em tabela com badges de status e ordenação |
| **Update** | Edição integral dos dados da tarefa e atalho rápido para marcação de "Concluída" |
| **Delete** | Exclusão permanente de registros do banco de dados |

---

## 3. Como Executar o Projeto Localmente

### Pré-requisitos

- Servidor web com suporte a PHP (ex: XAMPP, Laragon ou PHP Built-in Server)
- Servidor MySQL / MariaDB rodando na porta padrão `3306`

### Passo a Passo

**1. Clone o repositório:**

```bash
git clone https://github.com/Duduferalves/php-sistema-de-tarefas.git
```

**2. Mova para o diretório do servidor web:**

Coloque a pasta do projeto dentro de `htdocs` (XAMPP) ou no diretório equivalente do seu ambiente.

**3. Configure o Banco de Dados:**

Acesse seu gerenciador (phpMyAdmin ou DBeaver) e execute o script SQL abaixo:

```sql
CREATE DATABASE IF NOT EXISTS tarefas;
USE tarefas;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    status ENUM('pendente', 'concluida') DEFAULT 'pendente',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

INSERT INTO usuarios (usuario, senha) VALUES ('admin', MD5('123456'));
```

**4. Configure a Conexão:**

Se necessário, edite as credenciais `$user` e `$pass` no arquivo `conexao.php` para refletir o seu ambiente local.

**5. Acesse a aplicação:**

Abra o navegador e acesse:

```
http://localhost/php-sistema-de-tarefas/login.php
```

> **Credenciais de teste:** Usuário: `admin` | Senha: `123456`

---

*Projeto desenvolvido como requisito avaliativo (A2) — Disciplina de Desenvolvimento de Sistemas.*
