ApplicationName := fatih_13101990

build:
	docker-compose -p $(ApplicationName) build --no-cache

up-build:
	${MAKE} build
	docker-compose -p $(ApplicationName) up -d

up:
	docker-compose -p $(ApplicationName) up -d

down:
	docker-compose -p $(ApplicationName) down