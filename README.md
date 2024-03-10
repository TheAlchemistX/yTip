## Запуск проекта
### Разворачиваем репозиторий через ssh

````
git clone https://github.com/TheAlchemistX/yTip.git
````

### Устанавливаем зависимости

````
composer install
````

### Запускаем Sail контейнер

````
vendor/bin/sail up -d
````

### Запускаем миграции
````
vendor/bin/sail artisan migrate --seed
````

