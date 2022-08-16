/**
 * @file
 * Gulpfile for fortytwo.
 */
var gulp = require('gulp');
var del = require('del');
var $ = {};
$.sassLint = require('gulp-sass-lint');
$.plumber = require('gulp-plumber');
$.sourcemaps = require('gulp-sourcemaps');
$.sass = require('gulp-sass')(require('sass'));
$.postcss = require('gulp-postcss');
$.livereload = require('gulp-livereload');
$.jscs = require('gulp-jscs');

function sassLint() {
  return gulp.src('static/sass/**/*.s+(a|c)ss')
    .pipe($.sassLint({configFile: '.sass-lint.yml'}))
    .pipe($.sassLint.format())
    .pipe($.sassLint.failOnError());
}

function sassCompile() {
  var pcPlug = {
    autoprefixer: require('autoprefixer'),
    mqpacker: require('css-mqpacker'),
    flexbugs: require('postcss-flexbugs-fixes')
  };
  var pcProcess = [
    pcPlug.autoprefixer(),
    pcPlug.mqpacker(),
    pcPlug.flexbugs()
  ];

  var stream = gulp
    .src('static/sass/**/*.s+(a|c)ss')
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.sass({outputStyle: "expanded"}))
    .pipe($.postcss(pcProcess))
    .pipe($.sourcemaps.write());

  if (config.enable_livereload && config.livereload_hard_refresh) {
    stream.pipe($.livereload());
  }

  stream.pipe(gulp.dest("static/css"));
  return stream;
}

function compileJs() {
  var stream = gulp.src(['static/js/**/*.js'])
    .pipe($.jscs())
    .pipe($.jscs.reporter())
    .pipe(gulp.dest('./static/js'));

  if (config.enable_livereload && config.livereload_hard_refresh) {
    stream.pipe($.livereload());
  }

  return stream;
}

/**
 * Clean assets
 */
function clean() {
  return del(['static/css/*']);
}

function loadConfig(cb) {
  try {
    console.log('Loading config.json. Change the values in gulp.config.json to suit your needs.');
    config = require('./gulp.config.json');
  } catch (error) {
    console.log('No local config.json found. Using the defaults.');
    console.log('Debug info: ' + error.code + ' => ' + error);
  }

  cb();
}

/**
 * Watch files.
 */
function watchFiles() {
  gulp.watch('static/sass/**/*.+(scss|sass)', gulp.series(sassLint, sassCompile));
  gulp.watch('static/js/**/*.js', compileJs);

  if (config.enable_livereload) {
    console.log('Using live reload. Please enable your livereload browser plugin.');
    $.livereload.listen();

    gulp.watch('static/css/**/*.css', function(file) {
      $.livereload.changed(file.path);
    });

    gulp.watch('static/js/**/*.js', function(file){
      $.livereload.changed(file.path);
    });
  }
}

const watch = gulp.series(loadConfig, clean, gulp.series(sassLint, sassCompile), watchFiles);

// Export tasks.
exports.watch = watch;
exports.default = watch;
