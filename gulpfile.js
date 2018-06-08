/**
 * Gulp script.
 */

const concat = require('gulp-concat'),
    cssnano = require('gulp-cssnano'),
    del = require('del'),
    exec = require('child_process').exec,
    gulp = require('gulp'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    uglify = require('gulp-uglify');

/*
 * Cleaning tasks.
 */

// Concrete
gulp.task('clean-scripts', function () {
    return del([
        'public/scripts',
        'storage/framework/cache/i18n.js',
    ]);
});

gulp.task('clean-styles', function () {
    return del(['public/styles']);
});

gulp.task('clean-images', function () {
    return del(['public/images']);
});

gulp.task('clean-fonts', function () {
    return del(['public/fonts']);
});

gulp.task('clean-manifests', function () {
    return del([
        'public/manifest.json',
        'public/browserconfig.xml',
    ]);
});

// Global
gulp.task('clean', gulp.parallel(
    'clean-scripts',
    'clean-styles',
    'clean-images',
    'clean-fonts',
    'clean-manifests',
));

/*
 * Build tasks.
 */

// Concrete
gulp.task('build-scripts', gulp.series('clean-scripts', buildLanguages, gulp.parallel(buildPublicationScripts, function () {
    return gulp.src([
        'storage/framework/cache/i18n.js',
        'node_modules/jquery/dist/jquery.js',
        'node_modules/cookieconsent/src/cookieconsent.js',
        'resources/assets/scripts/**/*.js',
    ])
    .pipe(concat('app.js'))
    .pipe(sourcemaps.init())
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('public/scripts'));
})));

function buildLanguages() {
    return exec('artisan lang:js');
}

function buildPublicationScripts() {
    return gulp.src([
        'node_modules/prismjs/prism.js',
        'node_modules/prismjs/components/prism-http.js',
    ])
    .pipe(concat('publications.js'))
    .pipe(sourcemaps.init())
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('public/scripts'));
}

gulp.task('build-styles', gulp.series('clean-styles', gulp.parallel(buildPublicationStyles, function () {
    return gulp.src([
        'node_modules/normalize.css/normalize.css',
        'node_modules/cookieconsent/build/cookieconsent.min.css',
        'resources/assets/styles/colors.scss',
        'resources/assets/styles/mixins.scss',
        'resources/assets/styles/animations.scss',
        'resources/assets/styles/icons.scss',
        'resources/assets/styles/main.scss',
    ])
    .pipe(concat('app.css'))
    .pipe(sass().on('error', sass.logError))
    .pipe(cssnano({
        discardComments: {
            removeAll: true,
        },
        zindex: false,
    }))
    .pipe(gulp.dest('public/styles'));
})));

function buildPublicationStyles() {
    return gulp.src([
        'node_modules/prismjs/themes/prism.css',
        'resources/assets/styles/colors.scss',
        'resources/assets/styles/mixins.scss',
        'resources/assets/styles/publications.scss'
    ])
    .pipe(concat('publications.css'))
    .pipe(sass().on('error', sass.logError))
    .pipe(cssnano({
        discardComments: {
            removeAll: true
        },
        zindex: false
    }))
    .pipe(gulp.dest('public/styles'));
}

gulp.task('build-images', gulp.series('clean-images', function () {
    return gulp.src('resources/assets/images/**/*').pipe(gulp.dest('public/images'));
}));

gulp.task('build-fonts', gulp.series('clean-fonts', function () {
    return gulp.src('resources/assets/fonts/**/*').pipe(gulp.dest('public/fonts'));
}));

gulp.task('build-manifests', gulp.series('clean-manifests', gulp.parallel(buildWebManifest, buildBrowserManifest)));

function buildWebManifest() {
    return gulp.src('resources/assets/manifest.json').pipe(gulp.dest('public'));
}

function buildBrowserManifest() {
    return gulp.src('resources/assets/browserconfig.xml').pipe(gulp.dest('public'));
}

// Global
gulp.task('build', gulp.parallel(
    'build-scripts',
    'build-styles',
    'build-images',
    'build-fonts',
    'build-manifests',
));

/*
 * Helper tasks.
 */

// Watcher
gulp.task('watch', function () {
    gulp.watch('resources/assets/scripts/**/*.js', gulp.series('build-scripts'));
    gulp.watch('resources/assets/styles/**/*.scss', gulp.series('build-styles'));
    gulp.watch('resources/assets/images/**/*', gulp.series('build-images'));
    gulp.watch('resources/assets/fonts/**/*', gulp.series('build-fonts'));
});

// Default task
gulp.task('default', gulp.series('build', 'watch'));
