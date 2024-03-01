
## Criado com

 - [Laravel - v10.46.0](https://laravel.com/)
 - [Composer - v2.7.1](https://getcomposer.org/)
 - [PHP - v8.1.0](https://www.php.net/downloads.php)
 - [Docker - v24.0.5](https://www.docker.com/)

 

## Instalação

Instale o composer, verifique se ele esta instalado

```bash
    composer -v
```

Instale o docker

Baixe do git hub o sistema

```bash
    git clone https://github.com/LucasDaniel/payments.git
```

Execute o codigo para gerar o repositorio

```bash
    docker-compose up --build
```

Entre na pasta payments e execute o comando

```bash
    composer update
```

Aqui deve ter criado um arquivo .env.example
Renomei-o para .env
Adicione essa parte no seu arquivo .env

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=payaments
    DB_USERNAME=root
    DB_PASSWORD=root
```

Abra um outro terminal, entre na pasta payments do laravel e Execute

```bash
    php artisan serve
```

Exexute o migrate e seed do artisan
Provavelmente vai lhe pedir para criar a base de dados payment

```bash
    php artisan migrate
    php artisan db:seed
```
## Documentação da API

#### Retorna todos os itens [GET]

```http
  http://127.0.0.1:8000/api/transfer/all
  http://127.0.0.1:8000/api/state_transfer/all
  http://127.0.0.1:8000/api/type_user/all
  http://127.0.0.1:8000/api/user/all
  http://127.0.0.1:8000/api/wallet/all
```

#### Retorna um item [GET]

```http
  http://127.0.0.1:8000/api/transfer/{id}
  http://127.0.0.1:8000/api/state_transfer/{id}
  http://127.0.0.1:8000/api/type_user/{id}
  http://127.0.0.1:8000/api/user/{id}
  http://127.0.0.1:8000/api/wallet/{id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `string` | **Obrigatório**. O ID do item |

#### Fazer uma transferencia [POST]

```bash
    http://127.0.0.1:8000/api/transfer/transfer
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `value`      | `int` | **Obrigatório**. Valor a ser transferido |
| `payer`      | `int` | **Obrigatório**. Quem vai pagar |
| `payee`      | `int` | **Obrigatório**. Quem vai receber |

**Obs:** Usuarios lojistas não podem pagar uma transferência 

#### Retornar uma transferencia [POST]

```bash
    http://127.0.0.1:8000/api/transfer/returnTransfer
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id_transfer`      | `int` | **Obrigatório**. O id da transferencia que foi feita |

**Obs:** A transferencia precisa esta finalizada para conseguir reverter


## Possiveis problemas

Ao tentar dar php artisan serve, você pode se deparar com alguns problemas

Execute o comandos abaixo para resolve-los

```bash
    composer dump-autoload
```

## 🚀 Sobre mim
[Lucas - Linkedin - Clique aqui!!!](https://www.linkedin.com/in/lucas-dniel-beltrame-de-lima-rodrigues/)

