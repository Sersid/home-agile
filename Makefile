docker-up:
	cd laradock && docker-compose up -d nginx mariadb adminer
docker-down:
	cd laradock && docker-compose down
bash:
	cd laradock && docker-compose exec workspace bash
