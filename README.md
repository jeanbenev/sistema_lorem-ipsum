
<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Sistema de Gerenciamento de Projetos</h1>
    <h2 align="center">Empresa Lorem Ipsum</h1>
    <br>
</p>

O sistema nomeado "Sistema de Gerenciamento de Projetos" para a empresa Lorem Ipsum foi feito usando 
o framework [Yii 2](http://www.yiiframework.com/).

FUNCIONALIDADES
------------

### Modulo Projetos

O modulo `projetos` contem as seguintes funcionalidades:

~~~
1) Criação de projeto.
    • O campo de valor do projeto está configurado para que seja preenchido com valores no mínimo R$1.000,00 e no máximo R$10.000.000,00
    • **ATENÇÃO** O campo participante só terá opções para serem escolhidas se já existirem participantes cadastrados.
2) Visualização de um projeto.
3) Alteração de projeto.
4) Exclusão de um projeto.
5) Uma visualização de gerenciamento dos projetos criados.
    • Contém a acesso para a funcionalidade de "Simular Investimento"
~~~

### Modulo Participantes

O modulo `participantes` contem as seguintes funcionalidades:

~~~
1) Criação de participante.
2) Visualização de um participante.
3) Alteração de participante.
4) Exclusão de um participante.
    • **ATENÇÃO** Participantes que estão associados a projetos não podem ser excluídos.
5) Uma visualização de gerenciamento dos participantes criados.
~~~

### Modulo Equipes

O modulo `equipes` é um módulo invisível usado somente para a associação de participantes a projetos.

INSTALAÇÃO
------------

### Instalação via Composer

Se você não tiver o [Composer](http://getcomposer.org/), você pode instalá-lo seguindo as instruções
em [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Você pode então instalar o Yii2 no diretório raiz do seu servidor web localhost usando o seguinte comando:

~~~
composer create-project --prefer-dist yiisoft/yii2-app-basic sistema_lorem-ipsum
~~~

Agora você deve ser capaz de acessar o aplicativo através da seguinte URL, assumindo que `sistema_lorem-ipsum` é o diretório
diretamente na raiz do seu servidor web.

~~~
http://localhost/sistema_lorem-ipsum/web/
~~~

### Instalar a partir de um arquivo

A aplicação Yii2 está no diretório `basic` que está dentro do arquivo baixado [yiiframework.com](https://github.com/yiisoft/yii2/releases/download/2.0.41/yii-basic-app-2.0.41.tgz)

1) Pegue o diretório `basic` contido dentro do arquivo baixado e renomeie para `sistema_lorem-ipsum`

2) Coloque o diretório `sistema_lorem-ipsum` na raiz web do seu localhost.

### Instalar os pacotes necessarios para rodar a aplicação

É necessário que você tenha o composer instalado e execute os seguintes comandos na pasta do sistema `sistema_lorem-ipsum`

1) Yii2 Number: 
~~~
composer require kartik-v/yii2-number "dev-master"
~~~

2) Yii2 Date Picker: 
~~~
composer require 2amigos/yii2-date-picker-widget:~1.0
~~~

3) Yii2 Select2: 
~~~
composer require kartik-v/yii2-widget-select2 "dev-master"
~~~

4) Yii2 Dialog: 
~~~
composer require kartik-v/yii2-dialog "dev-master"
~~~

Agora você deve ser capaz de acessar o aplicativo através da seguinte URL, assumindo que `sistema_lorem-ipsum` é o diretório
diretamente na raiz da Web.

~~~
http://localhost/sistema_lorem-ipsum/web/
~~~

### Baixando o projeto do Github

Você precisa entrar no diretório `sistema_lorem-ipsum` e executar os seguintes comandos:

1) Iniciar o git no repositório:
~~~
git init
~~~

2) Conectar com o repositório remoto:
~~~
git remote add origin https://github.com/jeanbenev/sistema_lorem-ipsum.git
~~~

3) Buscar os arquivos do repositório remoto:
~~~
git fetch --all
~~~

4) Resetar para o HEAD do repositório remoto:
~~~
git reset --hard origin/master
~~~

Agora você deve ser capaz de acessar o aplicativo com as implementações através da seguinte URL, assumindo que `sistema_lorem-ipsum` é o diretório diretamente na raiz da Web.

~~~
http://localhost/sistema_lorem-ipsum/
~~~

ou

~~~
http://localhost/sistema_lorem-ipsum/web/
~~~

### Banco de Dados: Criando a estrutura e inserindo os dados

Dentro da pasta `/docs/` há dois arquivos. Um contendo o script de criação do banco de dados e suas tabelas e outro contendo um script 
para inserir alguns dados nessas tabelas. 

1) Execute o script do arquivo a seguir para criação do banco e a estrutura das tabelas:

~~~
docs/dump.sql
~~~

2) Execute o script do arquivo a seguir para inserção dos dados nas tabelas:

~~~
docs/dump_data.sql
~~~

ESTRUTURA DOS DIRETORIOS
-------------------

      docs/               Contem os arquivos de script para criação do banco de dados e descrição do sistema.
      config/             Contem as configurações da aplicação do banco de dados.
      vendor/             Contem os pacotes de widgets utilizados da aplicação.
      controllers/        Contem as classes controllers da apluicação.
      models/             Contem as classes models da aplicação.
      views/              Contem os arquivos views da aplicação.
      web/                Contem o arquivo index.php que inicia a aplicação.

REQUESITOS
------------

O requisito mínimo para este modelo de projeto é que seu servidor da Web suporte PHP 5.6.0.