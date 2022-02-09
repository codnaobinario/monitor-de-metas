# Programa de metas

## Como instalar

1. git clone git@github.com:prefeiturasp/programa-de-metas-wp.git
2. wget http://br.wordpress.org/wordpress-3.9.1-pt_BR.zip
3. unzip wordpress-3.9.1-pt_BR.zip
4. cp -R wordpress/* programa-de-metas-wp/
5. rm -rf wordpress && rm -rf wordpress-3.9.1-pt_BR.zip
6. Acessar url para instalação e configuração normal do wordpress
7. cd programa-de-metas-wp/wp-content/themes/pdm-andamento/
8. composer install
9. bower install
10. Ativar plugin "Timber"
11. Ativar tema "Andamento Programa de metas"
12. Configurar endereço da API em "Configurações" no menu "Aparência"
13. Pronto!

## Usando com Dockerfile

Você obrigatóriamente tem que ter um servidor mysql/mariadb externos, utilizando as seguintes VARIAVEIS DE AMBIENTE no docker na hora de subir.

```
DBDRIVE='mysql'         # seleciona o driver do banco de dados utilizado
DBHOST='127.0.0.1'      # aponta o servidor do banco de dados
DBPORT='3306'           # porta do banco de dados, utilizado somente se o BD nao usar a porta default.
DBNAME='pdm_wp'         # nome do banco de dados
DBUSER='wp'             # usuario do banco de dados
DBPASS='wp'             # senha do banco de dados
DBPREFIX='wp_'          # prefixo utilizado pelo wordpress, este é o padrao
URL='localhost'         # url do site
TITLE='title'           # titulo do site 
ADMUSER='admin'         # usuario administrativo do wordpress
ADMPASS='pass1234'      # senha para o usuario administrativo
ADMMAIL='a@a.com'       # e-mail para o usuario administrativo
```

ou seja, para executar apontando para o seu banco de dados, basta apenas executar:

```
docker run --name monitor-de-metas -e DBHOST=mysql.dyndns.org -e DBUSER=root -e DBPASS=pass -e URL=localhost nucleodigitalorg/monitor-de-metas
```
Com o container iniciado, acesse http://localhost/wp-admin e ao logar com admin e a senha pass1234 ele vai direto na tela que vai apontar para a configuração da URL da api, se você estiver usando o docker-compose.yaml que esta no projeto, basta colocar http://monitor-de-metas-api/ ou então se não estiver usando o docker-compose, basta apontar para a url que você designou para a sua API