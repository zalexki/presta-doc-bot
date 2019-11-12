# Presta doc bot

A single page for show the Pull request merged for PrestaShop documentation.

# Run project

## Install docker project

You can use the Makefile command for build container and execute some command.

`target: docker-up|du - Start docker containers`<br>
`target: docker-down|db - Stop docker containers`<br>
`target: docker-build|db - Setup PHP & (node)JS dependencies`<br>
`target: lint - Lint code for PSR12`<br>
`target: bash-app - Connect to the app docker container`<br>
`target: bash-node - Connect to the node docker container`<br>

## Project Specifics

Before use the presta-doc-bot you need to change the github credentials in .env file. <br>
`GITHUB_USERNAME=XXXX`
`GITHUB_SECRET=XXXX`

## Stack

Docker
PHP: 7.2
Symfony : 4.x
