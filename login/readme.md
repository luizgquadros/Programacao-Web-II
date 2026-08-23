# Telas de Login e Cadastro - Instagram Clone

Atividade prática de Programação Web II com o objetivo de criar telas de login e cadastro inspiradas na versão antiga do Instagram, integrando front-end com back-end em PHP e banco de dados MySQL.

## Tecnologias utilizadas

- HTML5
- CSS3
- PHP
- MySQL
- PDO (PHP Data Objects)
- XAMPP (servidor local)

## Funcionalidades

- Tela de login com validação de email e senha
- Tela de cadastro de novos usuários
- Integração com banco de dados MySQL via PDO
- Mensagens de feedback ao usuário (cadastro e login realizados ou erro)

## Estrutura do projeto

```
login/
├── css/
│   └── cadastrar.css
│   └── login.css
├── img/
├── php/
│   └── Usuario.class.php   (classe de conexão e operações no banco)
│   ├── cadastrar.php       (tela de cadastro)
│   ├── login.php           (tela de login)
├── banco.sql
└── README.md
```

## Como rodar o projeto

1. Instale o [XAMPP](https://www.apachefriends.org/)
2. Inicie o **Apache** e o **MySQL** no XAMPP
3. Copie a pasta `Programacao-Web-II-master` para `C:\xampp\htdocs\`
4. Acesse o banco de dados em `localhost/phpmyadmin`
5. Importe o arquivo `banco.sql` ou execute os comandos:

```sql
CREATE DATABASE etim;
USE etim;
CREATE TABLE usuario (
    id    INT PRIMARY KEY AUTO_INCREMENT,
    nome  VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);
```

6. Acesse o projeto no navegador:
```
localhost/Programacao-Web-II/login/php/login.php
```

## Banco de dados

A classe `Usuario.class.php` é responsável por toda comunicação com o banco. Possui dois métodos principais:

- `inserirUsuario()` — cadastra um novo usuário (INSERT)
- `buscarUsuario()` — verifica se o usuário existe no login (SELECT)

### PDO (PHP Data Objects)

PDO é uma camada de abstração que permite conectar o PHP a diferentes bancos de dados (MySQL, PostgreSQL, SQLite) sempre com a mesma sintaxe. Além disso, oferece recursos de segurança essenciais para proteger a aplicação.

### prepare()

O `prepare()` pré-compila a consulta SQL antes de executar, separando o comando SQL dos dados do usuário. Isso significa que o banco de dados já sabe o que é comando e o que é dado antes mesmo de receber os valores:

```php
$stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :e AND senha = :s");
// o banco já sabe que :e e :s são apenas dados, nunca comandos
```

### bindValue()

O `bindValue()` substitui os apelidos (`:e`, `:s`) pelos valores reais de forma segura, garantindo que os dados sejam sempre tratados como texto e nunca como comandos SQL:

```php
$stmt->bindValue(":e", $email);
$stmt->bindValue(":s", $senha);
```

### SQL Injection

SQL Injection é quando um invasor tenta inserir comandos SQL nos campos do formulário como se fossem dados normais. Por exemplo, digitar no campo de email:

```
' OR '1'='1
```

Sem proteção, isso viraria:

```sql
SELECT * FROM usuario WHERE email = '' OR '1'='1'
-- retorna todos os usuários pois 1=1 é sempre verdadeiro
```

Com `prepare()` e `bindValue()` isso não funciona, pois o banco trata a entrada como texto puro, nunca como comando SQL, protegendo os dados sensíveis da aplicação.

## Autor

@Luiz-Quadros
