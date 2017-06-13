var gulp           = require('gulp')
,   scss           = require('gulp-sass')
,   autoPrefixer   = require('gulp-autoprefixer')
,   sourcemaps     = require('gulp-sourcemaps')
,   concat         = require('gulp-concat')
,   rename         = require('gulp-rename')
,   pxtorem        = require('gulp-pxtorem')
,	cleanCSS	   = require('gulp-clean-css')
,   appData        = require('../util/application-data')
,   frontend       = appData.paths.frontend
,   build          = appData.paths.build;

gulp.task('css', function() {
  	gulp.src(frontend.root + '/assets/**/*.min.css')
  		//	.pipe(sourcemaps.init())        
	    //	.pipe(cleanCSS()) 
	    //	.pipe(autoPrefixer())
	    //	.pipe(rename({
	    //    suffix: '.min'
	    //  }))
	    //	.pipe(sourcemaps.write('./'))
	    .pipe(gulp.dest(build.root + '/'));

	gulp.src(frontend.root + '/assets/**/*.min.css.map')
		.pipe(gulp.dest(build.root + '/'));
});