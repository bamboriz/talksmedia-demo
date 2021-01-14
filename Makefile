start:
	docker-compose up --build -d --remove-orphans --force-recreate
ps:
	docker-compose ps
logs:
	docker-compose logs -f
stop:
	docker-compose stop
destroy:
	docker-compose down --volumes
composer-install:
	docker-compose exec php composer install
init:
	docker-compose exec php composer run-script repo:post-update
terminal:
	docker-compose exec php sh
test:
	docker-compose exec php composer run-script test:phpunit:no-cache