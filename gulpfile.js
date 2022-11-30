const gulp = require('gulp'),
    clean = require('gulp-clean'),
    concatCss = require('gulp-concat-css'),
    cssnano = require('gulp-cssnano'),
    sass = require('gulp-sass')(require('sass')),
    rename = require('gulp-rename'),
    webpack = require('webpack-stream');

gulp.task('watch', function () {
    gulp.watch(['src/scss/**/*.scss']).on(
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
    return gulp.src('src/scss/*.scss')
        .pipe(sass({
            includePaths: ['./node_modules'],
        }).on('error', sass.logError))
        .pipe(concatCss('style-shared.min.css'))
        .pipe(cssnano())
        .pipe(gulp.dest('assets/css/'));
});

gulp.task('minify-blocks', function () {
    return gulp.src('src/scss/blocks/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(rename({ suffix: '.min' }))
        .pipe(cssnano())
        .pipe(gulp.dest('assets/css/blocks'));
});

gulp.task('js-bundling', function () {
    return gulp.src('src/js/main.js')
        .pipe(webpack({
            mode: "production",
            entry: {
                main: './src/js/main.js',
                "remove-block-styles": './src/js/remove-block-styles.js',
            },
            output: {
                filename: '[name].js',
            },
        }))
        .pipe(gulp.dest('assets/js'));
});

gulp.task(
    'default',
    gulp.series(
        'clean-shared',
        'clean-blocks',
        'minify-shared',
        'minify-blocks',
        'js-bundling'
    )
);
