var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    q = require('q'),
    path = require('path'),
    fs = require('fs'),
    Grunticon = require('grunticon-lib'),

    paths = {
        sass: './assets/sass',
        css: './',
        images: './assets/images',
        icons: './assets/images/icons',
        templates: './templates'
    };

gulp.task('sass', function() {
    gulp.src(paths.sass + '/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 3 versions']
        }))
        .pipe(gulp.dest(paths.css));
});

gulp.task('icons', function() {
    var deferred = q.defer(),
        iconDir = paths.images + '/',
        options = { enhanceSVG: true, customselectors: require(paths.images + '/icons/_custom-selectors.json') };

        var files = fs.readdirSync(iconDir).map(function (fileName) {
            return path.join(iconDir, fileName);
        });

        var grunticon = new Grunticon(files, paths.images + '/icons', options);

        grunticon.process(function () {
            deferred.resolve();
        });

        return deferred.promise;
});


gulp.task('watch', ['sass', 'icons'], function() {
    gulp.watch(paths.sass + '/**/*.scss', ['sass']);
    gulp.watch([paths.images + '/**/*.svg', paths.images + '/icons/_custom-selectors.json'], ['icons']);
});

gulp.task('default', ['watch']);