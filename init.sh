# https://github.com/mechawrench/php-laravel-codespaces-devcontainer
cp .env.codespaces .env

composer install

php artisan key:generate
php artisan migrate:fresh --seed

npm install
npm run dev
