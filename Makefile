help:
	@egrep "^#" Makefile

install:
	docker-up
	docker-build
	grep -q -F "dashboard.docker" /etc/hosts || echo "127.0.0.2 aif.mydocker" | sudo tee -a /etc/hosts

# target: docker-up|du                  - Start docker containers
du: docker-up
docker-up:
	docker-compose up -d --build

# target: docker-down|db                - Stop docker containers
dd: docker-down
docker-down:
	docker-compose down

# target: docker-build|db               - Setup PHP & (node)JS dependencies
db: docker-build
docker-build: build-composer

build-composer:
	docker-compose run --rm app sh -c "composer install"

build-database:
	docker-compose run --rm app sh -c "bin/console doctrine:database:create"
	docker-compose run --rm app sh -c "bin/console doctrine:schema:update -f"


# target: lint                   	- Lint code for PSR12
lint: linter
linter:
	docker-compose exec app sh -c "vendor/bin/phpcs -n --report=diff --standard=PSR12 src/ && vendor/bin/phpcbf --standard=PSR12 src/"

# target: bash-app                      - Connect to the app docker container
ba: bash-app
bash-app:
	docker-compose exec app bash

# target: bash-node                     - Connect to the node docker container
bn : bash-node
bash-node:
	docker-compose run --rm node bash
