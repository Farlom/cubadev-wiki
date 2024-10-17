## Установка

```
    git clone https://github.com/Farlom/cubadev-wiki.git
    cd ./cubadev-wiki 
```

``` 
    composer install
    cp .env.example .env
```

```php
    php artisan key:generate
    php artisan migrate
    php artisan serve
```

# Возможности
- Поиск статьи на википедии (ru.wiki и en.wiki)
- Поиск статей, содержащий указанное слово
