/**
 * Define extensions, paths
 */

var gulp = require( 'gulp' ),
	sass = require( 'gulp-sass' ),
	prefix = require( 'gulp-autoprefixer' ),
	cssnano = require( 'gulp-cssnano' ),
	concat = require( 'gulp-concat' ),
	uglify = require( 'gulp-uglify' ),
	rename = require( 'gulp-rename' ),
	jshint = require( 'gulp-jshint' ),
	notify = require( 'gulp-notify' ),
	livereload = require( 'gulp-livereload' ),
	imagemin = require( 'gulp-imagemin' ),
	bower = require( 'gulp-bower' ),
	path = {
		WATCH_JS: [
			'assets/js/*.js',
			'assets/js/**/*.js'
		],
		WATCH_CSS: [
			'assets/scss/*.scss',
			'assets/scss/**/*.scss'
		],
		JS: 'assets/js/',
		CSS: 'assets/scss/',
		IMG: 'assets/img/',
		FONT: 'assets/fonts/',
		VENDOR: 'assets/vendor/',
		BUILD: 'assets/build',
		BUILD_CSS: [
			'assets/build/*.css',
			'assets/build/**/*.css'
		],
		BUILD_JS: [
			'assets/build/*.js',
			'assets/build/**/*.js',
			'!assets/build/admin.js' // I don't want to combine this one. He's special
		],
		DIST: 'assets/dist'
	};


/**
 * Install Tasks
 */

// Install Bower components
gulp.task( 'install', function() {
	return bower( path.VENDOR )
		.pipe( gulp.dest( path.VENDOR ) );
} );


/**
 * Development Tasks
 */

// Compile Sass files
gulp.task( 'sass', function() {
	gulp.src( [ path.CSS + '*.scss', path.CSS + '**/*.scss' ] )
		.pipe( sass()
			.on( 'error', notify.onError( {
				message: 'Sass failed. Check console for errors'
			} ) )
			.on( 'error', sass.logError ) )
		.pipe( prefix({ browsers: 'last 10 versions, not ie <= 9' }) )
		.pipe( gulp.dest( path.BUILD ) )
		.pipe( livereload() )
		.pipe( notify( 'Sass successfully compiled' ) );
} );

// Lint JS
gulp.task( 'lint', function() {
	gulp.src( [ path.JS + '*.js', path.JS + '**/*.js' ] )
		.pipe( jshint() )
		.pipe( jshint.reporter( 'default' ) )
			.on( 'error', notify.onError( function( file ) {
				if ( !file.jshint.success ) {
					return 'JSHint failed. Check console for errors';
				}
			} ) );
} );

// Compile JS
gulp.task( 'js', [ 'lint' ], function() {
	var frontendJS = path.WATCH_JS;
	frontendJS.push('!assets/js/admin.js');
	gulp.src( frontendJS )
		.pipe( concat( 'scripts.js' ) )
		.pipe( livereload() )
		.pipe( gulp.dest( path.BUILD ) )
		.pipe( notify( 'JS successfully compiled' ) );

	gulp.src( 'assets/js/admin.js' )
		.pipe( gulp.dest( path.BUILD ) )
		.pipe( notify( 'JS successfully compiled' ) );
} );

// Default
gulp.task( 'default', [ 'sass', 'js' ] );


/**
 * Production Tasks
 */

// Concatenate, minify, move style files
gulp.task( 'buildCss', function() {
	gulp.src( path.BUILD_CSS )
		.pipe( rename({ suffix: '.min' }) )
		.pipe( cssnano() )
		.pipe( gulp.dest( path.DIST ) );
} );

// Concatenate, minify, move script files
gulp.task( 'buildJs', function() {
	gulp.src( path.BUILD_JS )
		.pipe( rename({ suffix: '.min' }) )
		.pipe( uglify() )
		.pipe( gulp.dest( path.DIST ) );
} );

// Optimize images
gulp.task( 'compressImgs', function() {
	return gulp.src( [ path.IMG + '*.*', path.IMG + '**/*.*' ] )
		.pipe( imagemin() )
		.pipe( gulp.dest( path.IMG ) );
} );

// Build tasks
gulp.task( 'watch', function() {
	gulp.watch( path.WATCH_JS, [ 'js', 'buildJs' ] );
	gulp.watch( path.WATCH_CSS, [ 'sass', 'buildCss' ] );

	gulp.watch( path.BUILD_JS.concat(path.BUILD_CSS), ['stage'] );
	
	livereload.listen();
} );
gulp.task( 'stage', [ 'buildCss', 'buildJs' ] );
gulp.task( 'prod', [ 'buildCss', 'buildJs' ] );
