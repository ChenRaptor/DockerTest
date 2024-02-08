@servers(['web' => ['antoine-bonneau@13.39.150.46']])

@story('deploy')
    install-dependencies
    migrate
    optimize
@endstory

@task('install-dependencies', ['on' => ['web']])
    cd /home/antoine-bonneau/antoine-bonneau.dhonnabhain.me/app
    composer install
    npm i
    npm run build
@endtask

@task('migrate', ['on' => ['web']])
    cd /home/antoine-bonneau/antoine-bonneau.dhonnabhain.me/app
    php artisan migrate --force
@endtask

@task('optimize', ['on' => ['web']])
    cd /home/antoine-bonneau/antoine-bonneau.dhonnabhain.me/app
    composer install --optimize-autoloader --no-dev
    php artisan optimize:clear
    php artisan optimize
@endtask