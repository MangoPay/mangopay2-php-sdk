.PHONY: help
help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  tag  to modify the version"

.PHONY: tag
tag:
	$(if $(TAG),,$(error TAG is not defined. Pass via "make tag TAG=2.5.1"))
	@echo Tagging $(TAG)
	sed -i "s/const VERSION = '.*';/const VERSION = '$(TAG)';/" MangoPay/Libraries/RestTool.php
	php -l MangoPay/Libraries/RestTool.php

.PHONY: docker-test-php-56
docker-test-php-56: ## Test on PHP 5.6
	docker build -t php-test-env:5.6 php_env/PHP_5.6
	docker run -it -v "${PWD}":/usr/src/mangopay2-php-sdk \
	-w /usr/src/mangopay2-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:5.6 \
	/bin/bash -c "composer update -no --no-progress --no-suggest && vendor/bin/phpunit tests"

.PHONY: docker-test-php-70
docker-test-php-70: ## Test on PHP 7.0
	docker build -t php-test-env:7.0 php_env/PHP_7.0
	docker run -it -v "${PWD}":/usr/src/mangopay2-php-sdk \
	-w /usr/src/mangopay2-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:7.0 \
	/bin/bash -c "composer update -no --no-progress --no-suggest && vendor/bin/phpunit tests"

.PHONY: docker-test-php-80
docker-test-php-80: ## Test on PHP 8.0
	docker build -t php-test-env:8.0 php_env/PHP_8.0
	docker run -it -v "${PWD}":/usr/src/mangopay2-php-sdk \
	-w /usr/src/mangopay2-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:8.0 \
	/bin/bash -c "composer update -no --no-progress --no-suggest --ignore-platform-reqs && vendor/bin/phpunit tests"

.PHONY: docker-test-php-81
docker-test-php-81: ## Test on PHP 8.1
	docker build -t php-test-env:8.1 php_env/PHP_8.1
	docker run -it -v "${PWD}":/usr/src/mangopay2-php-sdk \
	-w /usr/src/mangopay2-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:8.1 \
	/bin/bash -c "composer update -no --no-progress --no-suggest --ignore-platform-reqs && vendor/bin/phpunit tests"

.PHONY: docker-test-php-82
docker-test-php-82: ## Test on PHP 8.2
	docker build -t php-test-env:8.2 php_env/PHP_8.2
	docker run -it -v "${PWD}":/usr/src/mangopay2-php-sdk \
	-w /usr/src/mangopay2-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:8.2 \
	/bin/bash -c "composer update -no --no-progress --no-suggest --ignore-platform-reqs && vendor/bin/phpunit tests"
