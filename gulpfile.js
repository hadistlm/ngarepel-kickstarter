'use strict';

let gulp    = require('gulp'),
    concat  = require('gulp-concat'),
    terser  = require('gulp-terser'),
    header  = require('gulp-header');

var pkg = require('./package.json');
var banner = ['/**',
  ' * <%= pkg.name %> - <%= pkg.description %>',
  ' * @version v<%= pkg.version %>',
  ' * @author <%= pkg.author %>',
  ' * @license <%= pkg.license %>',
  ' */',
  ''].join('\n');

// JS Builder
gulp.task('js-builder', function(){
    gulp.src(['public/assets/script-source/js/core.js', 'public/assets/script-source/js/*.js'])
        .pipe( concat('larastart-app.bundle.js') )
        .pipe(terser())
        .pipe(header(banner, { pkg : pkg } ))
        .pipe( gulp.dest('public/js/') )
});

// Css Builder
gulp.task('css-builder', function(){
    gulp.src([ 'public/assets/script-source/css/core.css', 'public/assets/script-source/css/*.css'])
        .pipe( concat('larastart-app.bundle.css') )
        .pipe(header(banner, { pkg : pkg } ))
        .pipe( gulp.dest('public/css/') )
});

// Watcher
gulp.task('watcher', function(){
    gulp.watch('public/assets/script-source/js/*.js', function(){
        gulp.start('js-builder');
    });

    gulp.watch('public/assets/script-source/css/*.css', function(){
        gulp.start('css-builder');
    });
});

// Default
gulp.task('default', ['watcher']);