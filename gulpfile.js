'use strict';

var gulp = require('gulp');

// Import dependencies
var concat   = require('gulp-concat');
var hash     = require ('gulp-hash');
var cleanCSS = require('gulp-clean-css');
var del      = require('del');

var source = 'themes/cocoa-eh/layouts/partials/css/';

var cssSources = [source + 'main.css',
                  source + 'min600px.css',
                  source + 'min769px.css',
                  source + 'chroma_native.css',
                  source + 'social-share-kit.css'];

var datadir = 'themes/cocoa-eh/data';
var data = {
css: datadir + '/css/'
};

var publishdir = 'themes/cocoa-eh/static';
var dist = {
css: publishdir + '/css/'
};
// Define tasks

gulp.task('css', function() {
  del(dist.css + '*')
  return gulp.src(cssSources)
      .pipe(cleanCSS({compatibility: 'ie8'}))
      .pipe(concat('site.min.css'))
      .pipe(hash())
      .pipe(gulp.dest(dist.css))
      .pipe(hash.manifest('hash.json'))
      .pipe(gulp.dest(data.css));
});

gulp.task('default', ['css']);
