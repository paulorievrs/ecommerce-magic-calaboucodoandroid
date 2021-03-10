<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Sobre o projeto
Um freelacing de um ecommerce de cartas de magic aonde seus clientes irão utiliza-lo tanto local quanto online.

## Como instalar
<a href="https://laravel.com/docs/7.x/installation#:~:text=If%20you%20installed%20Laravel%20via,env%20environment%20file."> Necessário ter o Laravel instalado, juntamente do PHP e do Composer </a>

Utilize o GitHub para fazer o clone o projeto, rode em seu terminal:

`git clone https://github.com/paulorievrs/ecommerce-magic-calaboucodoandroid.git
`

Após fazer isso, entre no projeto:

`cd ecommerce-magic-calaboucodoandroid`

E com isso instale as dependências:

`composer install`

Copie e cole o arquivo .env.example transformando-o em .env

`cp .env.example .env`

Gere a key necessária pra sua aplicação com:

`php artisan key:generate`

Necessário criar um banco com o nome especifícado no .env e após isso utilizar:

`php artisan migrate`

E com isso tudo rode:

`php artisan serve`

Acesse o projeto em: `localhost:8000`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
