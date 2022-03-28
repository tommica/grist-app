# Dev Setup

```

cp .env.example .env
nano .env
docker compose run app --rm touch /var/www/html/database/database.sqlite
docker compose run app --rm composer install
docker compose run app --rm php artisan migrate --seed
docker compose run app --rm php artisan grist:change_root_user_pass

docker compose up

curl localhost:8181

```

Login is root@test.test / the password you gave to the earlier command