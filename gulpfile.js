const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();

const paths = {
  scss: 'src/scss/style.scss',
  js: 'src/js/*.js',
  php: '**/*.php',
  cssOut: './dist/css/',
  jsOut: './dist/js/'
};

// Development SASS - Expanded + Autoprefixer
gulp.task('sass', function () {
  return gulp
    .src(paths.scss)
    .pipe(sass({ 
      outputStyle: 'expanded',
      quietDeps: true  // Potisni upozorenja iz node_modules
    }).on('error', sass.logError))
    .pipe(postcss([autoprefixer()]))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.cssOut))
    .pipe(browserSync.stream());
});

// Production SASS - Compressed + Minified
gulp.task('sass-prod', function () {
  return gulp
    .src(paths.scss)
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.cssOut));
});

// JavaScript - Minify
gulp.task('js', function () {
  return gulp
    .src(paths.js)
    .pipe(uglify().on('error', function(err) {
      console.error('JS Error:', err.message);
      this.emit('end');
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.jsOut))
    .pipe(browserSync.stream());
});

// Copy Bootstrap CSS/JS
gulp.task('copy-bootstrap', function () {
  gulp.src('node_modules/bootstrap/dist/css/bootstrap.min.css')
    .pipe(gulp.dest(paths.cssOut));
  
  return gulp.src('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')
    .pipe(gulp.dest(paths.jsOut));
});

// Copy Swiper CSS/JS
gulp.task('copy-swiper', function () {
  gulp.src('node_modules/swiper/swiper-bundle.min.css')
    .pipe(gulp.dest(paths.cssOut));
  
  return gulp.src('node_modules/swiper/swiper-bundle.min.js')
    .pipe(gulp.dest(paths.jsOut));
});

// BrowserSync Server
gulp.task('serve', function () {
  browserSync.init({
    proxy: 'http://smitasmile.locals7codesign',
    port: 3000,
    open: true,
    notify: false
  });

  gulp.watch(paths.scss, gulp.series('sass'));
  gulp.watch(paths.js, gulp.series('js'));
  gulp.watch(paths.php).on('change', browserSync.reload);
});

// Development
gulp.task('dev', gulp.series('sass', 'js'));

// Production build
gulp.task('build', gulp.series('sass-prod', 'js', 'copy-bootstrap', 'copy-swiper'));

// Watch + Serve
gulp.task('watch', gulp.series('dev', 'copy-bootstrap', 'copy-swiper', 'serve'));

// Default (development)
gulp.task('default', gulp.series('dev', 'copy-bootstrap', 'copy-swiper', 'serve'));