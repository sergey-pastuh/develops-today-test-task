#!/usr/bin/make

include .env

SHELL = /bin/sh

IMAGES_PREFIX := $(shell basename $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST)))))

PUBLISH_TAGS = latest
PULL_TAG = latest

APP_CONTAINER_NAME := ${PROJECT_NAME}_php-fpm
PGSQL_CONTAINER_NAME := ${PROJECT_NAME}_pgsql
NGINX_CONTAINER_NAME := ${PROJECT_NAME}_nginx

docker_bin := $(shell command -v docker 2> /dev/null)
docker_compose_bin := $(shell command -v docker-compose 2> /dev/null)
all_images = $(APP_IMAGE) $(APP_IMAGE_LOCAL_TAG) $(NGINX_IMAGE) $(NGINX_IMAGE_LOCAL_TAG)

clean: ## Remove images from local registry
	-$(docker_compose_bin) down -v
	$(foreach image,$(all_images),$(docker_bin) rmi -f $(image);)

# --- [ Development tasks ] -------------------------------------------------------------------------------------------

up: ## Start all containers (in background) for development
	$(docker_compose_bin) up -d

down: ## Stop all started for development containers
	$(docker_compose_bin) down

restart: up ## Restart all started for development containers
	$(docker_compose_bin) restart

shell: up ## Start shell into application container
	$(docker_bin) exec -it "$(APP_CONTAINER_NAME)" /bin/sh

shell_pgsql: up ## Start shell into application container
	$(docker_bin) exec -it "$(PGSQL_CONTAINER_NAME)" /bin/sh

shell_nginx: up ## Start shell into application container
	$(docker_bin) exec -it "$(NGINX_CONTAINER_NAME)" /bin/sh
