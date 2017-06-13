var gulp          = require('gulp')
,   sass          = require('gulp-sass')
,   autoPrefixer  = require('gulp-autoprefixer')
,   sourcemaps    = require('gulp-sourcemaps')
,   rename        = require('gulp-rename')
,   appData       = require('../util/application-data')
,   frontend      = appData.paths.frontend
,   build         = appData.paths.build;


//*** SASS compiler task
gulp.task('sass', function () {
  // bootstrap compilation
	gulp.src(frontend.root + '/sass/bootstrap.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) 
    .pipe(rename({
        suffix: '.min'
      }))   
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(build.root + '/plugins/bootstrap/css/'));

  // select2 compilation using bootstrap variables
	gulp.src(frontend.root + './assets/global/plugins/select2/sass/select2-bootstrap.min.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) 
    .pipe(rename({
        suffix: '.min'
      }))   
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(build.root +'/plugins/select2/css/'));

  // global theme stylesheet compilation
	gulp.src(frontend.root + '/sass/global/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) 
    .pipe(rename({
        suffix: '.min'
      }))   
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(build.root + '/css'));

	gulp.src(frontend.root + '/sass/apps/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) 
    .pipe(rename({
        suffix: '.min'
      }))   
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(build.root + '/css'));

	gulp.src(frontend.root + '/sass/pages/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) 
    .pipe(rename({
        suffix: '.min'
      }))   
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(build.root + '/pages/css'));

  // theme layouts compilation
	gulp.src(frontend.root + '/sass/layouts/layout/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) 
    .pipe(rename({
        suffix: '.min'
      }))   
    .pipe(sourcemaps.write())       
    .pipe(gulp.dest(build.root + '/layouts/layout/css'));

  gulp.src(frontend.root + '/sass/layouts/layout/themes/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError)) 
    .pipe(rename({
        suffix: '.min'
      }))   
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(build.root + '/layouts/layout/css/themes'));

});