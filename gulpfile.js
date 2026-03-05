const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();

// Production SASS task - compressed, bez komentara
gulp.task('sass-prod', function () {
  return gulp
    .src('src/scss/style.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(cleanCSS({ 
      compatibility: '*',
      format: 'single-line' // sve u jednom redu
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./dist/css/'));
});

// Development SASS task
gulp.task('sass-dev', function () {
  return gulp
    .src('src/scss/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./dist/css/'))
    .pipe(browserSync.stream());
});

// JavaScript task - minifikovani
gulp.task('js', function () {
  return gulp
    .src('src/js/main.js')
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./dist/js/'))
    .pipe(browserSync.stream());
});

// Copy Bootstrap CSS
gulp.task('copy-bootstrap-css', function () {
  return gulp
    .src('node_modules/bootstrap/dist/css/bootstrap.min.css')
    .pipe(gulp.dest('./dist/css/'));
});

// Copy Bootstrap JS
gulp.task('copy-bootstrap-js', function () {
  return gulp
    .src('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')
    .pipe(gulp.dest('./dist/js/'));
});

// Copy Swiper CSS
gulp.task('copy-swiper-css', function () {
  return gulp
    .src('node_modules/swiper/swiper-bundle.min.css')
    .pipe(gulp.dest('./dist/css/'));
});

// Copy Swiper JS
gulp.task('copy-swiper-js', function () {
  return gulp
    .src('node_modules/swiper/swiper-bundle.min.js')
    .pipe(gulp.dest('./dist/js/'));
});

// Copy Fonts
gulp.task('copy-fonts', function () {
  return gulp
    .src('src/fonts/**/*.woff2')
    .pipe(gulp.dest('./dist/fonts/'));
});

// Development server sa watchers
gulp.task('serve', function () {
  browserSync.init({
    proxy: "https://smitasmile.locals7codesign/",
    port: 3000,
    open: true,
    notify: false
  });

  gulp.watch('src/scss/**/*.scss', gulp.series('sass-dev'));
  gulp.watch('**/*.php').on('change', browserSync.reload);
  gulp.watch('src/js/*.js', gulp.series('js'));
});

// Production build - sve optimizovano
gulp.task('build', gulp.series(
  'sass-prod',
  'js',
  'copy-bootstrap-css',
  'copy-bootstrap-js',
  'copy-swiper-css',
  'copy-swiper-js',
  'copy-fonts'
));

// Development - samo sass i js
gulp.task('dev', gulp.series(
  'sass-dev',
  'js'
));

// Default task - development sa serve
gulp.task('default', gulp.series('dev', 'serve'));