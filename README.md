# Grist

Username is `root@test.test` and the pass will be given during the setup

## Prod Setup

```

curl https://github.com/tommica/grist-app/blob/master/docker-compose.prod.yml > docker-compose.yml
docker compose run app --rm php artisan key:generate --no-ansi --show # Copy the result to docker-compose.yml APP_KEY variable
# also update the DB_PASSWORD to something secure
docker compose run --rm app php artisan migrate --seed --force
docker compose run --rm -it app php artisan grist:change_root_user_pass

docker compose up

curl localhost:8181

```

## Dev Setup

```

cp .env.example .env
nano .env
docker compose run --rm app php artisan key:generate
docker compose run --rm app composer install
docker compose run --rm app php artisan migrate --seed
docker compose run --rm app php artisan grist:change_root_user_pass

docker compose up

curl localhost:8181

```