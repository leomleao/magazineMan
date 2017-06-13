var gulp           = require('gulp')
,   scss           = require('gulp-sass')
,   autoPrefixer   = require('gulp-autoprefixer')
,   sourcemaps     = require('gulp-sourcemaps')
,   concat         = require('gulp-concat')
,   pxtorem        = require('gulp-pxtorem')
,   appData        = require('../util/application-data')
,   frontend       = appData.paths.frontend
,   build          = appData.paths.build;

gulp.task("scswers", function(){
    gulp.src(frontend.root + frontend.scss + '/index.scss')
        .pipe(sourcemaps.init())
        .pipe(scss().on('error', scss.logError))
        .pipe(pxtorem())
        .pipe(concat('index.css'))
        .pipe(autoPrefixer())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(build.root + build.css))
});        