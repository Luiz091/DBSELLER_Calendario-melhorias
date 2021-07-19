- [Projeto](#projeto)
- [Deploy](#Deploy) 
- [Deploy usando Docker](#deploy-docker)
    - [Instalando Container / Servidor](#docker-servidor-up)
    - [Banco de dados](#docker-banco)
    - [Instalando dependências do projeto](#docker-dependencias-projeto)
    - [Removendo os containers](#docker-remover)
- [Deploy instalando servidor local ](#deploy-local)
- [Considerações](#consideracoes)


# Projeto
Esse projeto é um teste que visa avaliar as habilidades do candidato em javascript, php e orientação a objetos.

Baixe o projeto `calendario-melhorias` em seu computador conforme instruções do RH.

## Deploy 

Para facilitar o deploy da aplicação na sua maquina, disponibilizamos um servidor docker com todas as dependências necessárias.
**Recomendamos que utilize o container docker**.

Você pode optar também por levantar o projeto em sua maquina usando o seu servidor local se assim desejar.
Para isso você precisa que seu servidor atendenda as depêndencias do projeto.

<div id='deploy-docker'/>

## Deploy por Docker
Se você ainda não conhece o docker, vale a lida da [documentação oficial](https://docs.docker.com/).

Se ainda não tem o docker instalado você precisa instalá-lo:
 - [Linux](https://docs.docker.com/engine/install/)
 - [Windows](https://docs.docker.com/docker-for-windows/install/)
 - [Mac](https://docs.docker.com/docker-for-mac/install/)

 Instale também o [docker-compose](https://docs.docker.com/compose/install/)

<div id='docker-servidor-up'/>

### Instalando Container / Servidor

Primeiro você deve acessar o diretório do projeto `calendario-melhorias` como no exemplo:
```
/home/dbseller/calendario-melhorias/
```

Esse diretório possui o arquivo `docker-compose.yml`, é nele que fica as instruções para instalar/levantar o servidor. 


Após instalar o docker, para levantar o servidor, você deve executar o comando através do seu terminal (terminal linux ou cmd no windows).

```shell
docker-compose up -d
```

Se for a primeira vez que você executou, o comando vai baixar todas as dependências para levantar o servidor e você terá que agurardar o download.

Após instalado, o servidor levantará quase que instantaneamente. 

**Dica**, após finalizar seu trabalho no dia, você pode parar o servidor atravéz do comando `docker-compose stop`. Mais lembre-se de no dia seguinte levantar o servidor novamente. Basta acessar o diretório do projeto e executar `docker-compose up -d`

<div id='docker-banco'/>

### Banco de dados
O banco de dados esta dentro do container, para criar a base e inserir os dados iniciais, você precisa executar os seguintes comandos após levantar o servidor.

> Para isso copie e cole os comandos abaixo no seu terminal linha a linha.

```shell
docker exec -it dbsellerdb bash
cd /home
psql -U postgres -f database.sql
psql -U postgres -f seeds/seeds.sql
exit
```

<div id='docker-dependencias-projeto'/>

### Instalando dependências do projeto
O servidor apache assim como o php estão dentro do container, e para instalar as dependências você também deve fazer através do container.

> Para isso copie e cole os comandos abaixo no seu terminal linha a linha.

```shell
docker exec -it dbsellerphp bash
chmod +x composer
php composer install
exit
```

<div id='docker-remover'/>

### Removendo os containers
Após concluído o teste, você pode remover os containers através dos comandos:

- Para os containers em execução: `docker stop $(docker ps -a -q)`
- Deleta as imagens: `docker rmi -f $(docker images -q)`

<div id='deploy-local'/>

## Deploy instalando servidor local 

Se você usa linux, já deve estar acostumado com a instalação de um servidor web compatível com a sua distribuição linux.

Se você usa windows pode instalar o servidor utilizando XAMPP desde que atenda os requisitos abaixo. 

Você deve consultar o oráculo, digo google, para instruções de instalação do servidor local de acordo com seu OS.

Requisitos de servidor: 

- Servidor apache
- Postegres >= 9.4  
- PHP 5.6

PHP Extensions
- pdo_pgsql
- pgsql
- opcache
- zip
- bcmath
- bz2
- gd
- json
- mbstring
- mcrypt
- xml
- xmlrpc

Mais informações sobre as extensões do php, segue o [link](https://www.php.net/manual/pt_BR/extensions.alphabetical.php) da documentação.


Após instalar e configurar você deve criar o banco de dados. 
Para isso você deve logar no postgres e:
- criar um banco chamado `melhorias`
- rodar o script que estar no path `calendario-melhorias/database/database-local.sql`


> **ATENÇÃO** As suas correções/implementações devem funcionar de acordo com os requisitos do servidor, pois o projeto será avaliado em um servidor com essas dependências. Por isso recomendamos utilizar o container disponibilizado com o projeto. 


<div id='consideracoes'/>

## Considerações
Conforme instrução do RH, você deve criar um fork do projeto.

Em seu fork corrija os bugs reportado e implemente as melhorias propostas.

**Atenção** Não esqueça de comitar e dar push para o servidor as suas correções.

Desejamos a você um bom teste!

> O projeto não se trata de um projeto real, trata-se apenas de um teste, por isso solicitamos que não faça interações neste projeto.
Fork o projeto e para qualquer dúvida sobre as tarefas recrie-as no seu projeto e comente lá.

## Obervações
-- Realizado o desenvolvimento das páginas internas, bem como, as funções para manipulação dos dados.
-- Faltou a correção do bug relacionado aos caracteres especiais dos dados já existentes no db.
