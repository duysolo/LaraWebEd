var path = {
    baseAdmin: './../',
    distPathAdmin: './../dist/',
    bower: './bower_components/',
    npm: './node_modules/',
    core: './../core/',
    coreAdminThirdParty: './../core/third_party/',
    themeAdminAssets: './../theme/assets/'
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
    gulp.src(path.baseAdmin + 'scss/**/*.scss')
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
        .pipe(gulp.dest(path.baseAdmin + 'css/'));

    /*Concat css*/
    gulp.src([
            path.baseAdmin + 'css/**/*.css'
        ])
        .pipe(gulp.dest(path.distPathAdmin));
});

/*Min script*/
gulp.task('coreMinJs', function() {
    gulp.src([
            path.coreAdminThirdParty + 'jquery.min.js',
            path.bower + 'bootstrap-sass/assets/javascripts/bootstrap.min.js',
            path.coreAdminThirdParty + 'jquery-ui/jquery-ui.min.js',
            path.coreAdminThirdParty + 'js.cookie.min.js',
            path.bower + 'jquery-placeholder/jquery.placeholder.min.js',
            path.bower + 'modernizr/modernizr.js',
            path.coreAdminThirdParty + 'bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
            path.coreAdminThirdParty + 'jquery-slimscroll/jquery.slimscroll.min.js',
            path.coreAdminThirdParty + 'jquery.blockui.min.js',
            path.coreAdminThirdParty + 'uniform/jquery.uniform.min.js',
            path.coreAdminThirdParty + 'bootstrap-switch/js/bootstrap-switch.min.js',
            path.coreAdminThirdParty + 'bootstrap-modal/js/bootstrap-modalmanager.js',
            path.coreAdminThirdParty + 'bootstrap-modal/js/bootstrap-modal.js',
            path.coreAdminThirdParty + 'notific8/jquery.notific8.min.js',
            path.bower + 'bootstrap-confirmation2/bootstrap-confirmation.min.js',
            path.bower + 'jquery-validation/dist/jquery.validate.min.js',
            path.bower + 'jquery-validation/dist/additional-methods.min.js'
        ])
        .pipe(concat('core.min.js'))
        .pipe(uglify())
        .pipe(plumber({
            errorHandler: notify.onError("Error Script: <%= error.message %>")
        }))
        .pipe(gulp.dest(path.distPathAdmin));
});
gulp.task('scripts', function() {
    gulp.src([
            path.themeAdminAssets + 'layouts/layout/scripts/layout.js',
            path.baseAdmin + 'js/utility.js',
            path.baseAdmin + 'js/script.js'
        ])
        .pipe(concat('app.min.js'))
        .pipe(uglify())
        .pipe(plumber({
            errorHandler: notify.onError("Error Script: <%= error.message %>")
        }))
        .pipe(gulp.dest(path.distPathAdmin));
});
gulp.task('copyFonts', function() {
    gulp.src([
            path.bower + 'bootstrap-sass/assets/fonts/**/*.{ttf,woff,woff2,eof,svg,otf}',
            path.bower + 'font-awesome-sass/assets/fonts/**/*.{ttf,woff,woff2,eof,svg,otf}'
        ])
        .pipe(gulp.dest(path.baseAdmin + 'fonts/'));
});
gulp.task('copyPagesJs', function() {
    gulp.src([
            path.baseAdmin + 'js/pages/**/*.js',
        ])
        .pipe(uglify())
        .pipe(gulp.dest(path.distPathAdmin + 'pages/'));
});

/*Admin task*/
gulp.task("build", [
    'sass',
    'coreMinJs',
    'scripts',
    'copyFonts',
    'copyPagesJs'
]);

gulp.task("watch", function(){
    gulp.watch(path.baseAdmin + 'scss/**/*.scss', ['sass']);
    gulp.watch(path.baseAdmin + 'js/**/*.js', ['scripts', 'copyPagesJs']);
});