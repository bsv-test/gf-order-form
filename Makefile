dev-db:
	docker-compose up -d db-dev

dev-db-down:
	docker-compose down

npm-install:
	docker-compose run --rm node npm install

npm-dev:
	docker-compose run --rm node npm run dev

npm-watch:
	docker-compose run --rm node npm run watch

test:
	./artisan test

test-file:
	./artisan test "$T"

composer-require:
	docker run -v ${PWD}:/app --rm composer require "$T"
