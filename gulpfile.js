const gulp       = require('gulp'),
      concat     = require('gulp-concat'),
      cssnano    = require('gulp-cssnano'),
      sass       = require('gulp-sass'),
      sourcemaps = require('gulp-sourcemaps'),
      uglify     = require('gulp-uglify'),
      exec       = require('child_process').exec;

/**
 * Gulp script.
 */

/*
 * Build task.
 */
gulp.task('build', ['scripts', 'styles', 'images', 'fonts', 'manifest']);

/*
 * Watch task.
 */
gulp.task('watch', ['scripts', 'styles', 'images', 'fonts'], function () {
	gulp.watch('resources/assets/scripts/**/*.js', ['scripts']);
	gulp.watch('resources/assets/styles/**/*.scss', ['styles']);
	gulp.watch('resources/assets/images/**/*', ['images']);
	gulp.watch('resources/assets/fonts/**/*', ['fonts']);
});

/*
 * Scripts task.
 */
gulp.task('scripts', function () {
	
	// Clean the directory
	exec('rm -r public/js');
	
	// Compile the scripts
	gulp.src([
		'node_modules/jquery/dist/jquery.js',
		'resources/assets/scripts/**/*.js'
	])
	.pipe(concat('app.js'))
	.pipe(sourcemaps.init())
	.pipe(uglify())
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('public/js'));
	
	// Compile the publications scripts
	return gulp.src([
		'node_modules/prismjs/prism.js',
		'node_modules/prismjs/components/prism-http.js'
	])
	.pipe(concat('publications.js'))
	.pipe(sourcemaps.init())
	.pipe(uglify())
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('public/js'));
	
});

/*
 * Styles task.
 */
gulp.task('styles', function () {
	
	// Clean the directory
	exec('rm -r public/css');
	
	// Compile the styles
	gulp.src([
		'node_modules/normalize.css/normalize.css',
		'resources/assets/styles/colors.scss',
		'resources/assets/styles/mixins.scss',
		'resources/assets/styles/animations.scss',
		'resources/assets/styles/icons.scss',
		'resources/assets/styles/main.scss'
	])
	.pipe(concat('app.css'))
	.pipe(sass().on('error', sass.logError))
	.pipe(cssnano({
		discardComments: {
			removeAll: true
		},
		zindex: false
	}))
	.pipe(gulp.dest('public/css'));
	
	// Compile the publications styles
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
	.pipe(gulp.dest('public/css'));
	
});

/*
 * Images task.
 */
gulp.task('images', function () {
	
	// Clean the directory
	exec('rm -r public/images');
	
	// Copy the images
	return gulp.src('resources/assets/images/**/*').pipe(gulp.dest('public/images'));
	
});

/*
 * Fonts task.
 */
gulp.task('fonts', function () {
	
	// Clean the directory
	exec('rm -r public/fonts');
	
	// Copy the fonts
	return gulp.src('resources/assets/fonts/**/*').pipe(gulp.dest('public/fonts'));
	
});

/*
 * Manifest task.
 */
gulp.task('manifest', function () {
	
	// Clean the files
	exec('rm public/manifest.json');
	exec('rm public/browserconfig.xml');
	
	// Copy the files
	gulp.src('resources/assets/manifest.json').pipe(gulp.dest('public'));
	return gulp.src('resources/assets/browserconfig.xml').pipe(gulp.dest('public'));
	
});