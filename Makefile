.PHONY: up down build serve migrate clearcache

up:
	docker-compose config -q && \
	docker-compose up -d --force-recreate

down:
	docker-compose config -q && \
	docker-compose down

build:
	docker-compose config -q && \
	docker-compose build --pull

serve:
	docker-compose config -q && \
	docker-compose exec php-fpm php artisan serve --host 0.0.0.0

composer-install:
	docker-compose config -q && \
	docker-compose exec php-fpm composer install

composer-update:
	docker-compose config -q && \
	docker-compose exec php-fpm composer update

npm-install:
	docker-compose config -q && \
	docker-compose run --rm node npm i

npm-watch:
	docker-compose config -q && \
	docker-compose run --rm node npm run watch

webpack:
	docker-compose config -q && \
	docker-compose run --rm node npm run dev

migrate:
	docker-compose config -q && \
	docker-compose exec php-fpm php artisan migrate:refresh

clearcache:
	docker-compose exec php-fpm php artisan cache:clear; \
	docker-compose exec php-fpm php artisan clear-compiled; \
	docker-compose exec php-fpm php artisan config:clear; \
	docker-compose exec php-fpm php artisan route:clear; \
	docker-compose exec php-fpm php artisan view:clear; \
	docker-compose exec php-fpm php artisan optimize; \
	true
