FILES=-f ./docker-compose.yml -f ./auth/docker-compose.yml -f ./catalog/docker-compose.yml -f ./order/docker-compose.yml
up:
	docker-compose ${FILES} up -d

build:
	docker-compose ${FILES} build

down:
	docker-compose ${FILES} down

bash:
	docker exec -it ${service}-php bash

console:
	docker exec -it ${service}-php php bin/console ${cmd}

composer:
	docker exec -it ${service}-php composer ${cmd}

install:
	docker exec -it ${service}-php composer install