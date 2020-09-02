bash:
	docker-compose exec php-fpm bash
composer-create-project:
	docker-compose exec php-fpm composer create-project
composer-install:
	docker-compose exec php-fpm composer install
composer-update:
	docker-compose exec php-fpm composer update
composer-clearcache:
	docker-compose exec php-fpm composer clearcache
migrate-fresh:
	docker-compose exec php-fpm php artisan migrate:fresh --seed
perm:
	sudo chown ${USER}:${USER} ./* -R
test:
	docker-compose exec php-fpm vendor/bin/phpunit --testsuite=Expenses
