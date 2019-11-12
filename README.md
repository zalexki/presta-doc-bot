# Presta doc bot

A single page for show the Pull request merged for PrestaShop documentation.

# Run project

## Install docker project

You can use the Makefile command for build container and execute some command.

`make du: docker-up|du - Start docker containers`<br>
`make dd: docker-down|dd - Stop docker containers`<br>
`make db: docker-build|db - Setup PHP dependencies`<br>
`make lint: lint - Lint code for PSR12`<br>
`make ba: bash-app - Connect to the app docker container`<br>

## Project Specifics

Before use the presta-doc-bot you need to change the github credentials in .env file. <br>
`GITHUB_USERNAME=XXXX`
`GITHUB_SECRET=XXXX`

## Stack

Docker
PHP: 7.2
Symfony : 4.x
