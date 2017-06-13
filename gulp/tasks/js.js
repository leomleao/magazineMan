var gulp           = require('gulp')
,   plumber        = require('gulp-plumber')
,   sourcemaps     = require('gulp-sourcemaps')
,   uglify         = require('gulp-uglify')
,   rename         = require('gulp-rename')
,   gulpUtil       = require('gulp-util')
,   appData        = require('../util/application-data')
,   frontend       = appData.paths.frontend
,   build          = appData.paths.build;

gulp.task('js', ()=>{
    gulp.src([frontend.root + '/assets/pages/**/*.js','!/**/*.min.js'])
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(uglify().on('error', gulpUtil.log))
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(build.root + '/pages/'));

    gulp.src([frontend.root + '/assets/scripts/**/*.js','!/**/*.min.js'])
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(uglify().on('error', gulpUtil.log))
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(build.root + '/scripts/'));

    gulp.src([frontend.root + '/assets/layouts/layout/**/*.js','!/**/*.min.js'])
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(uglify().on('error', gulpUtil.log))
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(build.root + '/layouts/layout/'));

    gulp.src([frontend.root + '/assets/layouts/global/**/*.js','!/**/*.min.js'])
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(uglify().on('error', gulpUtil.log))
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(build.root + '/layouts/'));    

    gulp.src([frontend.root + '/assets/plugins/**/*', '!/**/*.css'])
        .pipe(gulp.dest(build.root + '/plugins/'));  

});

// var gulp           = require('gulp')
// ,   plumber        = require('gulp-plumber')
// ,   sourcemaps     = require('gulp-sourcemaps')
// ,   uglify         = require('gulp-uglify')
// ,   appData        = require('../util/application-data')
// ,   frontend       = appData.paths.frontend
// ,   build          = appData.paths.build
// // ,   source         = require('vinyl-source-stream')
// // ,   buffer         = require('vinyl-buffer')
// // ,   browserify     = require('browserify')
// // ,   watchify       = require('watchify')
// ;


// gulp.task('js', () => {
//     var b = browserify({
//         cache: {},
//         packageCache: {},
//         fullPaths: true
//     });
//     b = watchify(b);
//     b.on('update', () => {
//         bundleShare(b);
//     });

//     b.add(frontend.root + frontend.js + '/index.js');
//     bundleShare(b);
// });

// function bundleShare(b) {
//   b.bundle()
//     .pipe(source('index.js'))
//     .pipe(plumber({
//         handleError: (err) => {
//             console.log(err);
//             this.emit('end');
//         }
//     }))
//     .pipe(buffer())
//     .pipe(sourcemaps.init())
//     .pipe(uglify())
//     .pipe(sourcemaps.write('./'))
//     .pipe(gulp.dest(build.root + build.js));
// }