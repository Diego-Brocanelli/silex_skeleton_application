# Silex Skeleton
[Silex](silex.sensiolabs.org) é um micro framework craido por [Fabien Potencier](https://github.com/fabpot), mesmo criado do framework full stack [Symfony](https://symfony.com/).

# Estrutura de diretórios

* config
    *  bootstrap.php
        *  Arquivo de configurações globais para o projeto.
    *  routes.php
        *  Responsável por montar todas as rotas das aplicações, e para ficar melhor de ser utilizado, as rotas consomem o retorno do seu respectivo controller.
        *  Consome o arquivo bootstrap.php.
* public 
    * Reponsável por manter 
        * CSS
        * js
        * images
    * index.php
        * Responsável por executar a aplicação, utiliza o routes.php.
* src/App/Controller
    * AppController.php
        * welcomeAction
            * Retornar as informações para a view de boas vindas ao usuário.
* templates
    * Responsável por manter os layouts e as views a serem consumidas pelos controles.

# Configuração do servidor

### NGINX

```
server {
    server_name domain.tld www.domain.tld;
    root /var/www/project/web;

    location / {
        # try to serve file directly, fallback to front controller
        try_files $uri /index.php$is_args$args;
    }

    # If you have 2 front controllers for dev|prod use the following line instead
    # location ~ ^/(index|index_dev)\.php(/|$) {
    location ~ ^/index\.php(/|$) {
        # the ubuntu default
        fastcgi_pass   unix:/var/run/php5-fpm.sock;
        # for running on centos
        #fastcgi_pass   unix:/var/run/php-fpm/www.sock;

        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS off;

        # Prevents URIs that include the front controller. This will 404:
        # http://domain.tld/index.php/some-path
        # Enable the internal directive to disable URIs like this
        # internal;
    }

    #return 404 for all php files as we do have a front controller
    location ~ \.php$ {
        return 404;
    }

    error_log /var/log/nginx/project_error.log;
    access_log /var/log/nginx/project_access.log;
}
```

### Apache

#### Vhost

```
<VirtualHost *:80>
  DocumentRoot "/var/www/silexsandbox/web"
  ServerName silexsandbox
  <Directory "/var/www/silexsandbox/web">
    AllowOverride All
  </Directory>
</VirtualHost>
```

#### .htaccess

```
# /web/.htaccess
<IfModule mod_rewrite.c>
    Options -MultiViews

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Servidor embutido

#### Require PHP >= 5.4.0

```
php -S localhost:8080 -t public public/index.php
```

