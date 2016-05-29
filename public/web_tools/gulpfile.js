var path = {
    base: './../',
    distPath: './../dist/',
    bower: './bower_components/',
    npm: './node_modules/',
    coreThirdParty: './../third_party/'
};

var gulp = require("gulp");
var sass = require("gulp-sass");
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require("gulp-autoprefixer");
var uglify = require("gulp-uglify");
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var plumber = require('gulp-plumber');
var notify  = require('gulp-notify');

/*Min sass*/
gulp.task("sass", function(){
    gulp.src(path.base + 'scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(plumber({
            errorHandler: notify.onError("Error Sass: <%= error.message %>")
        }))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(autoprefixer({
            browsers: ['> 1%', 'last 2 versions']
        }))
        //.pipe(concat('app.min.css'))
        .pipe(sourcemaps.write('./map'))
        .pipe(gulp.dest(path.base + 'css/'));

    /*Concat css*/
    gulp.src([
            path.base + 'css/**/*.css'
        ])
        .pipe(gulp.dest(path.distPath));
});

/*Min script*/
gulp.task('coreMinJs', function() {
    gulp.src([
            path.coreThirdParty + 'jquery.min.js',
            path.bower + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',
            path.bower + 'jquery-placeholder/jquery.placeholder.min.js',
            path.coreThirdParty + 'modernizr.js'
        ])
        .pipe(concat('core.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(path.distPath));
});
gulp.task('scripts', function() {
    gulp.src([
            path.base + 'js/utility.js',
            path.base + 'js/script.js'
        ])
        .pipe(concat('app.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(path.distPath));
});
gulp.task('copyFonts', function() {
    gulp.src([
            path.bower + 'bootstrap-sass/assets/fonts/**/*.{ttf,woff,woff2,eof,svg,otf}',
            path.bower + 'font-awesome-sass/assets/fonts/**/*.{ttf,woff,woff2,eof,svg,otf}'
        ])
        .pipe(gulp.dest(path.base + 'fonts/'));
});
gulp.task('copyPagesJs', function() {
    gulp.src([
            path.base + 'js/pages/**/*.js'
        ])
        .pipe(uglify())
        .pipe(gulp.dest(path.distPath + 'pages/'));
});

/* task*/
gulp.task("build", [
    'sass',
    'coreMinJs',
    'scripts',
    'copyFonts',
    'copyPagesJs'
]);

gulp.task("watch", function(){
    gulp.watch(path.base + 'scss/**/*.scss', ['sass']);
    gulp.watch(path.base + 'js/**/*.js', ['scripts', 'copyPagesJs']);
});