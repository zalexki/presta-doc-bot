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

# target: tests                   	- Launch the test suite front and back
tests: test-back

test-back:
	docker-compose run --rm app sh -c "vendor/bin/php-cs-fixer fix --dry-run --diff --using-cache=no --diff-format udiff"
	docker-compose run --rm app sh -c "vendor/bin/phpstan analyse --configuration=/var/www/html/tests/phpstan/phpstan.neon"

# target: bash-app                      - Connect to the app docker container
ba: bash-app
bash-app:
	docker-compose exec app bash

# target: bash-node                     - Connect to the node docker container
bn : bash-node
bash-node:
	docker-compose run --rm node bash