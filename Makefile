up:
	docker-compose up -d

down:
	docker-compose down

test:
	vendor/bin/phpunit

assets-dev:
	docker-compose exec node npm run dev

assets-prod:
	docker-compose exec node npm run prod

assets-watch:
	docker-compose exec node npm run watch

assets-i-adminlte:
	docker-compose exec node npm install --save-dev admin-lte@v3.0.0-alpha.2

assets-i-fontawesome:
	docker-compose exec node npm install --save-dev @fortawesome/fontawesome-free

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache