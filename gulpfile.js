'use strict';

var gulp = require('gulp');

// Import dependencies
var concat   = require('gulp-concat');
var hash     = require ('gulp-hash');
var cleanCSS = require('gulp-clean-css');
var del      = require('del');
var lunr     = require('lunr');
var fs       = require('fs');

require("lunr-languages/lunr.stemmer.support")(lunr);
require('lunr-languages/lunr.multi')(lunr);
require("lunr-languages/lunr.fr")(lunr);

var source = 'themes/cocoa-eh/layouts/partials/css/';

var cssSources = [source + 'main.css',
                  source + 'min600px.css',
                  source + 'min769px.css',
                  source + 'chroma_native.css',
                  source + 'social-share-kit.css'];

var jsSources  = ['node_modules/lunr/lunr.js',
                  'node_modules/lunr-languages/lunr.stemmer.support.js',
                  'node_modules/lunr-languages/lunr.fr.js'];

var datadir = 'themes/cocoa-eh/data';
var data = {
css: datadir + '/css/'
};

var publishdir = 'themes/cocoa-eh/static';
var dist = {
css: publishdir + '/css/',
js: publishdir + '/js/'
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

gulp.task('js', function() {
  del(dist.js + 'lunr*')
  return gulp.src(jsSources)
      .pipe(gulp.dest(dist.js));
});

gulp.task('lunr-index', () => {
  const documentsEn = JSON.parse(fs.readFileSync('public/index.json'));
  const documentsFr = JSON.parse(fs.readFileSync('public/fr/index.json'));

  var titleMap = {};

  let lunrIndex = lunr(function() {
        this.use(lunr.multiLanguage('en', 'fr'));

        this.field("title", {
            boost: 10
        });
        this.field("tags", {
            boost: 5
        });
        this.field("content");
        this.ref("uri");

        documentsEn.forEach(function(doc) {
            titleMap[doc.uri] = doc.title;
            this.add(doc);
        }, this);
        documentsFr.forEach(function(doc) {
            titleMap[doc.uri] = doc.title;
            this.add(doc);
        }, this);
    });

  fs.writeFileSync('public/js/lunr-index.json', JSON.stringify(lunrIndex));
  fs.writeFileSync('public/js/title-map.json', JSON.stringify(titleMap));
});

gulp.task('default', ['css', 'js']);

gulp.task('post', ['lunr-index']);
