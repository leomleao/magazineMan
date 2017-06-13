var gulp     = require('gulp')
,   appData  = require('../util/application-data')
,   frontend = appData.paths.frontend
,   build    = appData.paths.build;

gulp.task('fonts', function(){
    gulp.src([frontend.root + '/assets/**/*.{eot,svg,ttf,woff,woff2}'])
        .pipe(gulp.dest(build.root));
});