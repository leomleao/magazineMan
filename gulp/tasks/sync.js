var gulp = require('gulp'),
    connect = require('gulp-connect-php'),
    browserSync = require('browser-sync');

gulp.task('sync', function (){
    browserSync({
      proxy: '127.0.0.1:8080/followmeup'
    });
  });

// gulp.task('php-serve', function () {
//     php.server({
//         hostname: '0.0.0.0',
//         port: 9001,
//         base: './',
//         open: false
//     });

//     var proxy = httpProxy.createProxyServer({});

//     browserSync({
//         notify: false,
//         port  : 9000,
//         server: {
//             baseDir   : './',
//             routes    : {
//                 '/bower_components': 'bower_components'
//             },
//             middleware: function (req, res, next) {
//                 var url = req.url;

//                 if (!url.match(/^\/(styles|fonts|bower_components)\//)) {
//                     proxy.web(req, res, { target: 'http://127.0.0.1:9001' });
//                 } else {
//                     next();
//                 }
//             }
//         }
//     });
