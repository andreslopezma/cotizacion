<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project
Antes de inicar el proyecto es importante tener instalado XAMPP dentro de la maquina y inicar el xampp normal
Una vez que se inice le XAMPP crear la base de datos llamada "tienda"
Luego ejecutar el comando php artisan migrate para crear las tablas
despues entrar a la base de datos y ejecutar el siguiente comando para crear productos de prueba
    insert into products(product_code,product_name,product_price,product_image,active,created_at) 
    values ('BRAV-001','Balon de Futbol',29.30,'',1,1);
    insert into products(product_code,product_name,product_price,product_image,active,created_at) 
    values ('BRAV-002','Balon de Basket',22.00,'https://wilsonstore.com.co/wp-content/uploads/2023/02/WTB9300XB07-1_0000_WTB9300XB_0_7_NBA_DRV_BSKT_OR.png.cq5dam.web_.1200.1200.jpg',1,1);
    insert into products(product_code,product_name,product_price,product_image,active,created_at) 
    values ('BRAV-003','Pelota de tenis',8.99,'https://assets.stickpng.com/images/580b585b2edbce24c47b2b90.png',1,1);
    insert into products(product_code,product_name,product_price,product_image,active,created_at) 
    values ('BRAV-004','Raqueta',49.50,'https://larrytennis.com/cdn/shop/products/WR074011U_9_900x.jpg',1,1);
    insert into products(product_code,product_name,product_price,product_image,active,created_at) 
    values ('BRAV-005','Palo de Golf',85.99,'https://i.ebayimg.com/thumbs/images/g/TEsAAOSwIK5fsjRp/s-l225.jpg',1,1);

IMPORTANTE: al momento de usar el endpoint que termina "/quotation" que se usa para crear las cotizaciones, la estrucutra de datos que resive es la siguiente 
{
    "name": "Andres Lopez",
    "lastname": "Lopez Manrique",
    "address": "Carrera 10",
    "date_quotation": "2023/09/22",
    "products": [
        {
            "product_id": 1,
            "quantity": 12
        },
        {
            "product_id": 2,
            "quantity": 3
        }
    ]
}