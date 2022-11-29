const gulp = require('gulp'),
    clean = require('gulp-clean'),
    concatCss = require('gulp-concat-css'),
    cssnano = require('gulp-cssnano'),
    sass = require('gulp-sass')(require('sass')),
    rename = require('gulp-rename');

gulp.task('watch', function () {
    gulp.watch(['assets/css/**/*.scss']).on(
        'change',
        gulp.series(
            'clean-shared',
            'clean-blocks',
            'minify-shared',
            'minify-blocks'
        )
    );
});

gulp.task('clean-shared', function () {
    return gulp.src('assets/css/style-shared.min.css', {
        read: false,
        allowEmpty: true,
    })
        .pipe(clean());
});

gulp.task('clean-blocks', function () {
    return gulp.src('assets/css/blocks/*.min.css', {
        read: false,
        allowEmpty: true,
    })
        .pipe(clean());
});

gulp.task('minify-shared', function () {
    return gulp.src('assets/css/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(concatCss('style-shared.min.css'))
        .pipe(cssnano())
        .pipe(gulp.dest('assets/css/'));
});

gulp.task('minify-blocks', function () {
    return gulp.src('assets/css/blocks/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cssnano())
        .pipe(gulp.dest('assets/css/blocks'));
});

gulp.task(
    'default',
    gulp.series(
        'clean-shared',
        'clean-blocks',
        'minify-shared',
        'minify-blocks'
    )
);
