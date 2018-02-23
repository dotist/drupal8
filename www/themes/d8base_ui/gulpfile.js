var gulp = require('gulp');
var stylus = require('gulp-stylus');
var concat = require('gulp-concat');
var nib = require('nib');
var rupture = require('rupture');

gulp.task('stylus', function() {
  return gulp.src('src/index.styl')
    .pipe(stylus({
      use: [
        nib(),
        rupture()
      ],
    }))
    .pipe(concat('styles.css'))
    .pipe(gulp.dest('css/'));
});

gulp.task('build', ['stylus']);

gulp.task('watch', ['build'], function () {
  gulp.watch('src/**/*.styl', ['stylus']);
});

gulp.task('default', ['watch']);
