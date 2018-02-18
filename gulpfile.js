const gulp = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');

gulp.task('sass:dev', () => gulp.src('./wp-content/themes/norwalk/sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./wp-content/themes/norwalk/stylesheets'))
)

gulp.task('sass:prod', () => gulp.src('./wp-content/themes/norwalk/sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./wp-content/themes/norwalk/stylesheets'))
);

gulp.task('sass:watch', () => gulp.watch('./wp-content/themes/norwalk/sass/**/*.scss', ['sass:dev']));

gulp.task('default', ['sass:dev', 'sass:watch']);

gulp.task('prod', ['sass:prod']);