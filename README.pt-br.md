# square-two

[![en](https://img.shields.io/badge/lang-en-red.svg)](https://github.com/rafomiya/square-two/blob/main/README.md)



Projeto de uma loja virtual, feito com HTML, CSS e PHP. Deploy feito na [Heroku](https://www.heroku.com/).
O progresso da aplicação pode ser visto [aqui](https://square-two.herokuapp.com/).


## Pré-requistos:

- O gerenciador de dependências Composer.
- Uma [conta na Heroku](https://signup.heroku.com/login).



<hr>

## Iniciando o Heroku

​	Assumindo que você já tenha a CLI do Heroku, execute o comando abaixo e siga os passos para fazer login:

```bash
heroku login -i
```

​	Para criar sua aplicação, use o seguinte comando na raiz do projeto:

```bash
cd <diretorio_do_projeto>
heroku create
```

<hr>

## Dependências do projeto

​	Precisamos de um arquivo `composer.json` na raiz da aplicação, declarando cada dependência do projeto dentro da chave `require`. 
​	Ex.:

```JSON
{
    "require": {
        "monolog/monolog": "1.0.*@beta",
        "php": "^7.4.0"
    }
}
```

​	Se o projeto não possuir dependências, ainda é requerido que o `composer.json` exista, mesmo que vazio (contendo apenas `{}`), pois é assim que o Heroku reconhece qual runtime será utilizada.

​	Depois de declarar suas dependências, execute `composer update` na linha de comando, para que seja possível executar a aplicação localmente. Esse comando também gerará o arquivo `composer.lock`, que serve para "travar" as dependências utilizadas em cada versão do projeto.

> OBS: Não esqueça de commitar as alterações a cada passo do desenvolvimento da aplicação :)



<hr>

## `Procfile`

​	O próximo passo é definir um arquivo `Procfile`, que deve ficar, obrigatoriamente, na raiz do projeto. De forma resumida, esse arquivo de texto, que não possui extensão, instrui como iniciar a aplicação. Crie o arquivo e escreva isso nele:

​	```web: vendor/bin/heroku-php-apache2```

### *Document root*

​	A *document root* é o diretório em que os arquivos `.php` se localizam. É possível alterá-la no `Procfile`, adicionando o caminho da pasta no final do arquivo:

​	```web: vendor/bin/heroku-php-apache2 public/```

​	No exemplo acima, a *document root* é a pasta `public`.

> OBS: Normalmente, o diretório `vendor` contém as dependências da aplicação. Ela deve ser sempre mantida no arquivo `.gitignore`, por questões de segurança. Se você não sabe o que é um `.gitignore`, dê uma olhada [nisso](https://docs.github.com/en/get-started/getting-started-with-git/ignoring-files).



<hr>

## Variáveis de ambiente

​	Informações confidenciais, como senhas e tokens, devem ser armazenadas e acessadas de maneira segura. Portanto, usam-se as variáveis de ambiente, que apesar de não serem visíveis no código fonte, podem ser acessadas por meio de métodos especiais, como o `getenv()`.

### `heroku config`

​	A Heroku possui um simples comando para adicionar variáveis de ambiente à aplicação:

```bash
heroku config:set NOME_DA_VAR=VALOR
```

​	Se quiséssemos definir `123` como `PASSWORD`, usaríamos:

```bash
heroku config:set PASSWORD=123
```

​	Para verificá-las:

```bash
heroku config
```

> Ateção! Não dê nomes muito genéricos às suas variáveis de ambiente. Elas podem ser sobrepostas por variáveis pré-definidas da Heroku no momento do deploy. Eu aprendi isso da maneira difícil :sweat_smile:.



<hr>

## Deploy

​	Agora que temos os arquivos necessários, podemos fazer o deploy propriamente dito. Antes disso, verifique se todos os arquivos com dados sensíveis estão no `.gitignore`. Após isso, escreva no terminal:

```bash
git add . # adicionando os arquivos de commit
git commit -m "<mensagem_do_commit>" # commitando
git push heroku main # fazendo o deploy
```
