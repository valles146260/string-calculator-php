.PHONY : main build-image build-container start test shell stop clean
main: build-image build-container

build-image:
	docker build -t docker-php-calculator .

build-container:
	docker run -dt --name docker-php-calculator -v .:/540/calculator docker-php-calculator
	docker exec docker-php-calculator composer install

start:
	docker start docker-php-calculator

test: start
	docker exec docker-php-calculator ./vendor/bin/phpunit tests/$(target)

shell: start
	docker exec -it docker-php-calculator /bin/bash

stop:
	docker stop docker-php-calculator

clean: stop
	docker rm docker-php-calculator
	rm -rf vendor
