var gulp     = require('gulp')
,   del      = require('del')
,   appData  = require('../util/application-data')
,   build    = appData.paths.build;

gulp.task('cleanjs', function() {
    del([build.root + '/js/*'], {force : true}).then(paths => {
        console.log('Removed * from path ' + build.root + '/js');
    });
});

gulp.task('cleancss', function() {
    del([build.root + '/css/*'], {force : true}).then(paths => {
        console.log('Removed * from path ' + build.root + '/css');
    });
});

gulp.task('clean', function() {
    del([build.root + '/*'], {force : true}).then(paths => {
        console.log('Removed * from path ' + build.root);
    });
});