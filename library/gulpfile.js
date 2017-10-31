// Gulp
var gulp = require('gulp'),
  watch = require('gulp-watch'),
  sass = require('gulp-sass'),
  autoprefixer = require('gulp-autoprefixer'),
  concat = require('gulp-concat'),
  plumber = require('gulp-plumber'),
  uglify = require('gulp-uglify'),
  rename = require('gulp-rename');

// Styles tasks
gulp.task('styles', function () {
  return gulp.src('./sass/**/*.scss')
    .pipe(plumber())
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'))
      .pipe(
        sass({
          outputStyle: 'compressed'
        })
        .on('error', sass.logError)
      )
      .pipe(
        rename({
          suffix: '.min'
        })
      )
      .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
      })
    )
    .pipe(gulp.dest('./css'));
});

// Scripts tasks
gulp.task('scripts:vendors', function () {
  return gulp.src([
      "./js/vendors/mobile-detect.min.js",
      "./js/vendors/mobile-detect-modernizr.js",
      "./js/vendors/cssua.min.js",
      "./js/vendors/vue.min.js",
      "./js/vendors/**/*.js"
    ])
    .pipe(plumber())
    .pipe(concat('vendors.js'))
    .pipe(gulp.dest('./js/'));
});
gulp.task('scripts:vendors:min', ['scripts:vendors'], function () {
  return gulp.src('./js/vendors.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(
      rename({
        suffix: '.min'
      })
    )
    .pipe(gulp.dest('./js/'));
});
gulp.task('scripts:app', function () {
  return gulp.src('./js/app.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(
      rename({
        suffix: '.min'
      })
    )
    .pipe(gulp.dest('./js/'));
});
gulp.task('scripts', ['scripts:vendors', 'scripts:vendors:min', 'scripts:app']);

// Watch tasks
gulp.task ('watch', function () {
  gulp.watch('./sass/**/*.scss', ['styles']);
  gulp.watch('./js/app.js', ['scripts:app']);
});

// Gulp default
gulp.task('default', ['styles', 'scripts', 'watch']);

