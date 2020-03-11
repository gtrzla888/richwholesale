FIG=docker-compose
GROUP_ID=GROUP_ID=$(shell id -g)
APPLICATION_NAME=richwholesale
RUN=$(FIG) run --rm $(APPLICATION_NAME)
EXEC=$(FIG) exec $(APPLICATION_NAME)
EXEC_T=$(FIG) exec -T $(APPLICATION_NAME)
CONSOLE=gosu docker bin/console
DOCKER_APPLICATION=registry.gitlab.com/pepperstone/docker-application:master
DOCKER_PROXY=registry.gitlab.com/pepperstone/docker-nginx:master
DOCKER_VOLUMES_PATH=~/Projects/volume
MYSQL_ROOT_PASSWORD=root
MYSQL_ROOT_HOST=%
#DOCKER_LOCALHOST_IP=$(shell ipconfig getifaddr en0)

DOCKER_NETWORK_NAME=melbrother_network
DOCKER_NETWORK_FOUND=$(shell docker network ls | grep -c $(DOCKER_NETWORK_NAME))

DOCKER_MYSQL_NAME=mysql
DOCKER_MYSQL_FOUND=$(shell docker ps -f "name=$(DOCKER_MYSQL_NAME)" | grep -c $(DOCKER_MYSQL_NAME))
DOCKER_MYSQL_PORT=3306


stop:                   ## Stop containers
stop:
	$(FIG) kill
	$(FIG) rm -v --force

up:                     ## Run containers
up: docker-network docker-mysql
	$(GROUP_ID) docker-compose up -d

debug:                  ## Debug container as user
debug:
	$(EXEC) gosu docker bash

debug-root:             ## Debug container as Root user
debug-root:
	$(EXEC) bash

##
## Docker
##---------------------------------------------------------------------------
docker-network:         ## Create network if needed
docker-network:
	@if [ $(DOCKER_NETWORK_FOUND) -eq 0 ]; then\
		echo "Docker network not found. We're creating it ... ";\
		docker network create --driver=bridge $(DOCKER_NETWORK_NAME);\
	fi

docker-mysql:           ## Create MySQL Container if needed
docker-mysql:
	@if [ $(DOCKER_MYSQL_FOUND) -eq 0 ]; then\
		echo "Container MySQL not found. We're running it ... ";\
		docker run -d --rm --name $(DOCKER_MYSQL_NAME) -v $(DOCKER_VOLUMES_PATH)/mysql:/var/lib/mysql -p 3306:3306 --network=$(DOCKER_NETWORK_NAME) -e MYSQL_ROOT_PASSWORD=$(MYSQL_ROOT_PASSWORD) -e MYSQL_ROOT_HOST=$(MYSQL_ROOT_HOST) mysql/mysql-server:5.7;\
	fi

docker-clean:           ## Clear Docker cache (destroy containers)
docker-clean:
	docker rm -f $$(docker ps -aq)
	docker rmi -f $$(docker images | grep "^<none>" | awk "{print $$3}")
