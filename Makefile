SHELL=/bin/bash

# to see all colors, run
# bash -c 'for c in {0..255}; do tput setaf $c; tput setaf $c | cat -v; echo =$c; done'
# the first 15 entries are the 8-bit colors

# define standard colors
ifneq (,$(findstring xterm,${TERM}))
	BLACK        := $(shell tput -Txterm setaf 0)
	RED          := $(shell tput -Txterm setaf 1)
	GREEN        := $(shell tput -Txterm setaf 2)
	YELLOW       := $(shell tput -Txterm setaf 3)
	LIGHTPURPLE  := $(shell tput -Txterm setaf 4)
	PURPLE       := $(shell tput -Txterm setaf 5)
	BLUE         := $(shell tput -Txterm setaf 6)
	WHITE        := $(shell tput -Txterm setaf 7)
	RESET 		 := $(shell tput -Txterm sgr0)
else
	BLACK        := ""
	RED          := ""
	GREEN        := ""
	YELLOW       := ""
	LIGHTPURPLE  := ""
	PURPLE       := ""
	BLUE         := ""
	WHITE        := ""
	RESET        := ""
endif

REPOSITORY_NAME=coza:1.0

VERSION ?= develop

REGISTRY_URI = ghcr.io

IMAGE_PHP = ${REGISTRY_URI}/tienvanbui/clothingshop/php
IMAGE_NGINX = ${REGISTRY_URI}/tienvanbui/clothingshop/nginx

.PHONY: help
help:
	@echo "Usage:"
	@echo ""
	@echo " $(GREEN)make build [VERSION=latest]   $(RESET)Build docker images"
	@echo " $(GREEN)make push  [VERSION=latest]   $(RESET)Push docker images"
	@echo " $(GREEN)make login                    $(RESET)Login docker registry"
	@echo " $(GREEN)make logout                   $(RESET)Logout docker registry"
	@echo " $(GREEN)make help                     $(RESET)Show this help output"
	@echo ""

.PHONY: stop_container
stop_container: 
	@echo ">>> Stop coza container"
	@if [ -n `$$(docker ps -q -aq --filter "ancestor=${REPOSITORY_NAME}")` ]; then \
		echo "No running containers found for ${REPOSITORY_NAME}"; \
	else \
		docker container stop $$(docker ps -q -aq --filter "ancestor=${REPOSITORY_NAME}"); \
	fi

.PHONY: remove_container
remove_container:
	@echo ">>> Remove coza container"
	@if [ -n `$$(docker ps -q -aq --filter "ancestor=${REPOSITORY_NAME}")` ]; then \
		echo "No running containers found for ${REPOSITORY_NAME}"; \
	else \
		docker container remove $$(docker ps -q -aq --filter "ancestor=${REPOSITORY_NAME}"); \
	fi

.PHONY: remove_image
remove_image:
	@echo ">>> Remove coza image" 
	@if docker images --format "{{.Repository}}:{{.Tag}}" | grep -q `"^${REPOSITORY_NAME}$"`; then \
		docker rmi ${REPOSITORY_NAME}; \
	else \
		echo "No image found"; \
	fi 

.PHONY: build_image stop_container remove_container remove_image
build_image:  stop_container remove_container remove_image
	@echo ">>> Build coza images"
	docker build -t ${REPOSITORY_NAME} -f docker/Dockerfile . --no-cache 
	docker run -it -d ${REPOSITORY_NAME} sh 
	docker exec -it $$(docker ps -q -aq --filter "ancestor=${REPOSITORY_NAME}") sh 


.PHONY: docker_login
docker_login: 
	@echo ">>> Docker login"
	docker login ${REGISTRY_URI}

.PHONY: docker_logout
docker_logout: 
	@echo ">>> Docker logout"
	docker logout ${REGISTRY_URI}

.PHONY: clean
clean: 
	@echo ">> Cleaning workspace ..."
	rm -rf bootstrap/cache/*.php
	rm -rf storage/app/public/*
	rm -rf storage/framework/cache/data/*
	rm -rf storage/framework/sessions/*
	rm -rf storage/framework/testing/*
	rm -rf storage/framework/views/*.php
	rm -rf storage/logs/*.log
	rm -rf coverage
	rm -rf vendor
	rm -rf node_modules
	rm -rf public/css/app.css
	rm -rf public/js/app.js
	rm -rf public/storage
	# [ -f .env ] && mv .env .env.backup

.PHONY: build_php
build_php:
	@echo ">>> Building php image..."
	docker build \
	--file docker/Dockerfile \
	--tag ${IMAGE_PHP}:${VERSION} \
	--target app \
	.
.PHONY: build_nginx
build_nginx:
	@echo ">>> Building nginx image..."
	docker build \
	--file docker/Dockerfile \
	--tag ${IMAGE_NGINX}:${VERSION} \
	--target web \
	.

.PHONY: build build_php build_nginx
build: clean build_php build_nginx
	# [ -f .env.backup] && [! -f .env] && mb .env.backup .env

.PHONY: push_php
push_php:
	@echo ">>> Pushing image php..."
	docker push ${IMAGE_PHP}:${VERSION}

.PHONY: push_nginx
push_nginx:
	@echo ">>> Pushing image nginx..."
	docker push ${IMAGE_NGINX}:${VERSION}

.PHONY: push push_php push_nginx
push: push_php push_nginx
