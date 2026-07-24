# Qillqay — containerized development targets
# All commands route through 'podman compose', never docker.
# ---------------------------------------------------------------------------

.DEFAULT_GOAL := help
.PHONY: help

help: ## Show available targets
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
		| sort \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-22s\033[0m %s\n", $$1, $$2}'

build: ## Build the container image
	podman compose build

up: ## Start the container (detached)
	podman compose up -d

down: ## Stop and remove the container
	podman compose down

shell: ## Open a bash shell inside the container
	podman compose run --rm app bash

install: ## Run 'composer install' inside the container
	podman compose run --rm app composer install

test: ## Run the complete PHPUnit test suite
	podman compose run --rm app vendor/bin/phpunit

test-guia-remision-publico: ## Run GuiaRemisionPublicoTest only
	podman compose run --rm app vendor/bin/phpunit --filter GuiaRemisionPublicoTest

test-guia-remision-privado: ## Run GuiaRemisionPrivadoTest only
	podman compose run --rm app vendor/bin/phpunit --filter GuiaRemisionPrivadoTest

clean: ## Remove containers and volumes
	podman compose down -v

# Recipe: first-time setup
#   make build && make install && make test
#
# Vendor lives on the host filesystem (/vendor is gitignored).
# Re-run 'make install' after changing composer.json.
