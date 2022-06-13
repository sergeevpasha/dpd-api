.PHONY: up
up:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down

.PHONY: rebuild
rebuild:
	docker-compose build --no-cache

.PHONY: install
install:
	docker exec dpd-api_workspace npm install

.PHONY: bash
bash:
	docker exec -it dpd-api_workspace bash
