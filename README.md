# Composer install issue

Related to issue: https://github.com/composer/composer/issues/12057

Issue when installing larger Composer packages on a synced folder.

To replicate:

```
vagrant up
vagrant ssh
cd /srv/code
./replicate-issue.sh
```

The second installation should fail.
