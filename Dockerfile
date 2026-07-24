# Qillqay development & testing container
# Requires: Podman (or Docker) with Compose plugin
#
# Build:  podman compose build
# Shell:  podman compose run --rm app bash

FROM php:8.1-cli

# ---------------------------------------------------------------------------
# System dependencies for wkhtmltopdf
# ---------------------------------------------------------------------------
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        ca-certificates \
        fontconfig \
        libfontconfig1 \
        libjpeg62-turbo \
        libonig-dev \
        libxrender1 \
        libxext6 \
        libssl3 \
        libzip-dev \
        unzip \
        wget \
        xfonts-75dpi \
        xfonts-base \
    ; \
    rm -rf /var/lib/apt/lists/*

# ---------------------------------------------------------------------------
# wkhtmltopdf 0.12.6
# The .deb is built for bookworm but runs fine on trixie when its deps are
# already satisfied (pre-installed above). dpkg may still warn; we use
# apt-get -f install to reconcile any remaining issues.
# ---------------------------------------------------------------------------
RUN set -eux; \
    wget -q -O /tmp/wkhtmltox.deb \
        https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6.1-3/wkhtmltox_0.12.6.1-3.bookworm_amd64.deb; \
    dpkg -i /tmp/wkhtmltox.deb || true; \
    apt-get update; \
    apt-get install -y -f --no-install-recommends; \
    rm /tmp/wkhtmltox.deb; \
    rm -rf /var/lib/apt/lists/*; \
    wkhtmltopdf --version

# ---------------------------------------------------------------------------
# PHP extensions (beyond what php:8.1-cli already ships)
# ---------------------------------------------------------------------------
RUN docker-php-ext-install mbstring zip

# ---------------------------------------------------------------------------
# Composer (from official Composer image, single COPY layer)
# ---------------------------------------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
