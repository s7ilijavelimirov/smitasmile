const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();

// Development SASS task
gulp.task('sass', function () {
  return gulp
    .src('src/scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./dist/css/'))
    .pipe(browserSync.stream());
});

// Production SASS task (compressed)
gulp.task('sass-prod', function () {
  return gulp
    .src('src/scss/**/*.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./dist/css/'));
});

// JavaScript task
gulp.task('js', function () {
  return gulp
    .src('src/js/*.js')
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

// Development server
gulp.task('serve', gulp.series('sass', 'copy-bootstrap-css', 'copy-bootstrap-js', 'copy-swiper-css', 'copy-swiper-js', function () {
  browserSync.init({
    proxy: "http://smitasmile.locals7codesign",
    port: 3000,
    open: true,
    notify: false
  });

  gulp.watch('src/scss/**/*.scss', gulp.series('sass'));
  gulp.watch('**/*.php').on('change', browserSync.reload);
  gulp.watch('src/js/*.js', gulp.series('js'));
}));

// Production build
gulp.task('build', gulp.series('sass-prod', 'js', 'copy-bootstrap-css', 'copy-bootstrap-js', 'copy-swiper-css', 'copy-swiper-js'));

// Default task (development)
gulp.task('default', gulp.series('sass', 'js', 'serve'));