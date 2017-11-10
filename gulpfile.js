//initialize all of our variables
var watch, browserSync, gulp, autoprefixer, concat, imagemin, minifyCSS, rename, concatCss, plumber, sass, shell, sourceMaps, gutil, uglify, reload;

var autoPrefixBrowserList = ['last 7 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'];

//load all of our dependencies
//add more here if you want to include more libraries

watch = require('gulp-watch');
browserSync = require('browser-sync');
reload = browserSync.reload;
gulp = require('gulp');
autoprefixer = require('gulp-autoprefixer');
concat = require('gulp-concat');
imagemin = require('gulp-imagemin');
minifyCSS = require('gulp-minify-css');
rename = require('gulp-rename');
plumber = require('gulp-plumber');
sass = require('gulp-sass');
shell = require('gulp-shell');
sourceMaps = require('gulp-sourcemaps');
gutil = require('gulp-util');
uglify = require('gulp-uglify');
concatCss = require('gulp-concat-css');

gulp.task('browserSync', function () {
    //watch files
    var files = [
        'development/images/**/*.*',
        'development/scripts/**/*.*',
        'development/styles/**/*.*',
        '*.php'
    ];

    //initialize browsersync
    browserSync.init(files, {
        //browsersync with a php server
        proxy: "localhost/ihordu4enko.dev",//your local port
        notify: false
    });
});

//compressing images & handle SVG files
gulp.task('images', function () {
    gulp.src('development/images/*.*')
    //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        .pipe(imagemin({optimizationLevel: 7, progressive: true, interlaced: true}))
        .pipe(gulp.dest('images/', {"mode": "0777"}))
        .pipe(reload({stream: true}));
});

//minify our vendor files
gulp.task('vendorStyles', function () {
    //get all vendor libraries
    return gulp.src('development/css/**/*.css')
    //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        //catch errors
        .on('error', gutil.log)
        //the final filename of our combined css file
        .pipe(concatCss('vendor.min.css'))
        .pipe(minifyCSS())
        //where to save our final, compressed css file
        .pipe(gulp.dest('styles/', {"mode": "0777"}))
        //notify browserSync to refresh
        .pipe(reload({stream: true}));
});


//compiling our SCSS files
gulp.task('styles', function () {
    //the initializer / master SCSS file, which will just be a file that imports everything
    return gulp.src('development/sass/**/*.scss')
    //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        //include SCSS and list every "include" folder
        .pipe(sass({errLogToConsole: true, outputStyle: 'compressed'}))
        .pipe(autoprefixer({
            browsers: autoPrefixBrowserList,
            cascade: true
        }))
        //catch errors
        .on('error', gutil.log)
        .pipe(rename({suffix: ".min"}))
        //get our sources via sourceMaps
        .pipe(sourceMaps.write())
        //where to save our final, compressed css file
        .pipe(gulp.dest('styles/', {"mode": "0777"}))
        //notify browserSync to refresh
        .pipe(reload({stream: true}));
});

//compiling our vendor Javascripts
gulp.task('vendorScripts', function () {
    //this is where our dev JS scripts are
    return gulp.src('development/scripts/*.js')
    //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        //this is the filename of the compressed version of our JS
        .pipe(concat('vendor.min.js', {newLine: '\n;'}))
        .pipe(uglify())
        //catch errors
        .on('error', gutil.log)
        //where we will store our finalized, compressed script
        .pipe(gulp.dest('scripts/', {"mode": "0777"}))
        //notify browserSync to refresh
        .pipe(reload({stream: true}));
});

//compiling our  Javascripts
gulp.task('scripts', function () {
    //this is where our dev JS scripts are
    return gulp.src('development/index.js')
    //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        //this is the filename of the compressed version of our JS
        .pipe(concat('index.min.js'))
        .pipe(uglify())
        //catch errors
        .on('error', gutil.log)
        //where we will store our finalized, compressed script
        .pipe(gulp.dest('scripts/', {"mode": "0777"}))
        //notify browserSync to refresh
        .pipe(reload({stream: true}));
});

//basically just keeping an eye on all  PHP files
gulp.task('php', function () {
    //watch any and all  PHP files and refresh when something changes
    return gulp.src('*.php')
        .pipe(plumber())
        .pipe(reload({stream: true}))
        //catch errors
        .on('error', gutil.log);
});

gulp.task('watch', function () {
    watch('development/css/**/*.*', function () {
        gulp.start('vendorStyles');
    });
    watch('development/sass/**/*.scss', function () {
        gulp.start('styles');
    });
    watch('development/scripts/**/*.js', function () {
        gulp.start('vendorScripts');
    });
    watch('development/index.js', function () {
        gulp.start('scripts');
    });
    watch('development/images/**/*.*', function () {
        gulp.start('images');
    });
});

gulp.task('build', [
    'watch',
    'images',
    'vendorStyles',
    'styles',
    'vendorScripts',
    'scripts'
]);

//this is our master task when you run `gulp` in CLI / Terminal
//this is the main watcher to use when in active development
//  this will:
//  startup the web server,
//  start up browserSync
//  compress all scripts and SCSS files

gulp.task('default', ['build', 'browserSync']);


