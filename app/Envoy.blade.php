@servers(['web' => ['antoine-bonneau@13.39.150.46']])

@story('deploy')
    install-dependencies
    migrate
    optimize
@endstory

@task('install-dependencies', ['on' => ['web']])
    composer install
    npm i
    npm run build
@endtask

@task('migrate', ['on' => ['web']])
    php artisan migrate
@endtask

@task('optimize', ['on' => ['web']])
    composer install --optimize-autoloader --no-dev
    php artisan optimize:clear
    php artisan optimize
@endtask