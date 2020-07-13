# retail_aplication
Sistema de controle de locações de carros

Projeto feito para teste da  volvex, com o framework symphony PHP

### Dados de acesso padão da aplicação
E-mail: admin@volvox.com.br

Senha: admin


## Passo a passo para instalação
1 - Clonar a aplicação do repositorio

2 - composer install

3 - php bin/console doctrine:database:create

4 - php bin/console doctrine:migration:migrate

5 - php bin/console doctrine:fixtures:load

6 - symfony server:start 
