<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'centaur-imdb');

// Project repository
set('repository', 'git@github.com:chas-academy/centaurs-06-imdb-clone.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('production')
    ->hostname('165.227.236.122')
    ->user('deployer')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/www.centaurs-imdb.me')
    ->set('branch', 'master');

host('staging')
    ->hostname('165.227.236.122')
    ->user('deployer')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/staging.centaurs-imdb.me')
    ->set('branch', 'staging');

host('develop')
    ->hostname('165.227.236.122')
    ->user('deployer')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/develop.centaurs-imdb.me')
    ->set('branch', 'develop');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    run('sudo service php7.1-fpm reload');
});
before('deploy:symlink', 'artisan:migrate');

