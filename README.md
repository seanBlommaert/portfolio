# Personal portfolio

This project contains the personal portfolio of __Sean Blommaert__.
It was based on [Composer template for Drupal projects](https://github.com/drupal-composer/drupal-project). 
Read the documentation of the template for more information.

## Docker

Configuration is included to set up a local development environment through Docker. The docker configuration is based on the [docker compose drupal](https://github.com/reinier-vegter/docker-compose-drupal) project on Github.

Follow the instruction on Github to set up the generic containers like MySQL and Mailhog, including the DNS settings. After starting the generic containers, you can use the following commands in the root folder of this project:

- Start containers:
```
export DOCKERDNS=$(docker inspect -f "{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}" dockerdns); docker-sync start --daemon; docker-compose up -d
```
- Stop container:
```
docker-compose down; docker-sync stop
```
- Execute commands in PHP container:
```
bash -c "clear && docker-compose exec php sh"
```

## Install

First you need to [install composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx). When using the docker setup, composer is already part of the container.

> Note: The instructions below refer to the [global composer installation](https://getcomposer.org/doc/00-intro.md#globally).
You might need to replace `composer` with `php composer.phar` (or similar) 
for your setup.

After that you can install the project from the root of the application:

```
composer install
```

With `composer require ...` you can download new modules to the 
application.

```
cd some-dir
composer require drupal/devel:8.*
```

When adding new modules, make sure a specific version is specified. We don't want composer to download a different version unintentionally when building/updating the site.

__Install clean new site__

The [Config Installer](https://www.drupal.org/project/config_installer) module was added to be able to install a clean site from configuration.
More information on the module can be found in [this blog](https://evolvingweb.ca/blog/restoring-drupal-8-site-configuration-files). 
Using drush you can easily set up a fresh installation for test/development:
- Make sure all composer packages are installed.
- Create _web/sites/default/settings.local.php_.
- Add database credentials and other custom config in your _settings.local.php_.
- Run the drush site install from the _web_ directory:
```drush si config_installer --account-name=[username-user-1] --account-pass=[your-password]```


## Module / core updates

- Update code:
```composer update```
- Run DB updates:
```drush updb```
- Export config:
```drush cex```
- Commit changes:
```git commit -m 'Describe your awesome changes here.'```
- Push changes:
```git push```



## Configuration

The config split module is used to optimize the configuration import and export.
We want to keep development configuration out of the production environment (Field UI / Devel etc)
and add special handling for some configuration (Webform / Group menu's).

Read [this awesome article](https://blog.liip.ch/archive/2017/04/07/advanced-drupal-8-cmi-workflows.html) for more info on the workflow.

__Workflow__
- Export config:
```drush cex```
- Commit changes:
```git commit -m 'Describe your awesome changes here.'```
- Merge changes:
```git pull --rebase```
- Update dependencies:
```composer install```
- Run DB updates:
```drush updb```
- Import configuration:
```drush cim```
- Push changes:
```git push```

__Production__

Make sure the excluded config is not removed on the production environment with the following workflow:

- Export excluded config:
```drush -y csex excluded```
- Import configuration:
```drush cim```


## Patches

To add a patch to drupal module foobar insert the patches section in the extra 
section of composer.json:
```json
"extra": {
    "patches": {
        "drupal/foobar": {
            "Patch description": "URL to patch"
        }
    }
}
```