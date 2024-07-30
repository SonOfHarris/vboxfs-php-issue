# Composer install issue

Related to issue: https://github.com/composer/composer/issues/12057

Issue when installing larger Composer packages on a synced folder.

## Installation

Ensure `vagrant` and the `vagrant-vbguest` plugin has been installed:

```
vagrant plugin install vagrant-vbguest
```

Then provision the virtual machine:

```
vagrant up
```

## Usage

To replicate the issue:

```
vagrant ssh
cd /srv/code
php replicate-issue.php
```

The first installation of the Composer package will be successful as it is downloaded.
The second installation will fail when attempting to copy it from the cache to the synced folder.
