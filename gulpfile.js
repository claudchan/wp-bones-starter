// Gulp
var gulp = require('gulp'),
  livereload = require('gulp-livereload'),
  sass = require('gulp-sass'),
  autoprefixer = require('gulp-autoprefixer'),
  concat = require('gulp-concat'),
  plumber = require('gulp-plumber'),
  uglify = require('gulp-uglify'),
  rename = require('gulp-rename');

// Styles tasks
gulp.task('styles', function () {
  return gulp.src('./library/sass/**/*.scss')
    .pipe(plumber())
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./library/css'))
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
    .pipe(gulp.dest('./library/css'))
    .pipe(livereload());
});

// Scripts tasks
gulp.task('scripts:vendors', function () {
  return gulp.src([
      "./library/js/vendors/mobile-detect.min.js",
      "./library/js/vendors/mobile-detect-modernizr.js",
      "./library/js/vendors/cssua.min.js",
      "./library/js/vendors/vue.min.js",
      "./library/js/vendors/**/*.js"
    ])
    .pipe(plumber())
    .pipe(concat('vendors.js'))
    .pipe(gulp.dest('./library/js/'))
    .pipe(livereload());
});
gulp.task('scripts:vendors:min', ['scripts:vendors'], function () {
  return gulp.src('./library/js/vendors.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(
      rename({
        suffix: '.min'
      })
    )
    .pipe(gulp.dest('./library/js/'))
    .pipe(livereload());
});
gulp.task('scripts:app', function () {
  return gulp.src('./library/js/app.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(
      rename({
        suffix: '.min'
      })
    )
    .pipe(gulp.dest('./library/js/'))
    .pipe(livereload());
});
gulp.task('scripts', ['scripts:vendors', 'scripts:vendors:min', 'scripts:app']);

// Watch tasks
gulp.task ('watch', function () {
  livereload.listen();
  gulp.watch('./library/sass/**/*.scss', ['styles']);
  gulp.watch('./library/js/app.js', ['scripts:app']);
});

// Gulp default
gulp.task('default', ['styles', 'scripts', 'watch']);

