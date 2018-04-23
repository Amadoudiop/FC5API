FC5API
=====

A Symfony project created on October 9, 2017, 8:37 am.

# Database

Load datafixtures in database
Players ,Goalkeeper and Arsenal Club
```
php bin/console doctrine:fixtures:load --append
```

# Initialization JWT authentication

Generate the SSH keys :

``` bash
$ mkdir -p config/jwt # For Symfony3+, no need of the -p option
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

After that, configure your pass phrase in `parameters.yml` :

``` yaml
jwt_key_pass_phrase:  ''   # ssh key pass phrase
```


