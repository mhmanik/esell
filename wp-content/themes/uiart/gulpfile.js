const project         = require('./package.json');
const gulp            = require('gulp');
const less            = require('gulp-less');
const LessAutoprefix  = require('less-plugin-autoprefix');
const autoprefix      = new LessAutoprefix({ browsers: ["> 1%", "last 2 versions"] });
const rtlcss          = require('gulp-rtlcss');
const beautify        = require('gulp-jsbeautifier');
const wpPot           = require('gulp-wp-pot');
const clean           = require('gulp-clean');
const zip             = require('gulp-zip');
const rollup          = require('gulp-better-rollup');
const babel           = require('rollup-plugin-babel');

gulp.task('babel', function () {
	return gulp.src('src/js/main.js')
	.pipe(rollup(
	{
		plugins: [babel(
		{
			presets: ['@babel/preset-env'],
			sourceMap: false,
			comments: false
		}
		)]
	},
	{
		format: 'iife',
		intro: 'var $ = jQuery;'
	}))
	.pipe(beautify({
		js: {
			indent_char: '\t',
			indent_size: 1
		}
	}))
	.pipe(gulp.dest('assets/js/'));
});

gulp.task('less', function () {
	return gulp.src(['style.less', 'elementor.less', 'gutenberg.less', 'woocommerce.less'], {cwd: 'src/less'})
	.pipe(less({
		plugins: [autoprefix]
	}))
	.pipe(beautify({
		indent_char: '\t',
		indent_size: 1
	}))
	.pipe(gulp.dest('assets/css/'));
});

gulp.task('pot', function () {
	return gulp.src(['**/*.php', '!__*/**', '!src/**', '!assets/**'])
	.pipe(wpPot( {
		domain: project.name,
		bugReport: 'support@wooctheme.com',
		team: 'WoocTheme <info@wooctheme.com>'
	} ))
	.pipe(gulp.dest('languages/'+project.name+'.pot'));
});



gulp.task('rtl', function () {
return gulp.src([
	'assets/css/*.css',
	'!assets/css/owl.carousel.css',
	'!assets/css/owl.carousel.min.css',
	'!assets/css/owl.theme.default.css',
	'!assets/css/owl.theme.default.min.css',
	'!assets/css/font-awesome.min.css',
	'!assets/css/rtl.css'
])
.pipe(rtlcss())
.pipe(gulp.dest('assets/css-auto-rtl/'));
});

gulp.task('clean', function () {
	return gulp.src('__build/*.*', {read: false})
	.pipe(clean());
});

gulp.task('zip', function () {
	return gulp.src(['**', '!__*/**', '!node_modules/**', '!src/**', '!gulpfile.js', '!__uiart_todo.txt', '!package.json', '!package-lock.json', '!todo.txt', '!sftp-config.json', '!testing.html'], { base: '..' })
	.pipe(zip(project.name+'.zip'))
	.pipe(gulp.dest('__build'));
});

gulp.task('watch', function() {
	gulp.watch('src/less/**/*.less', gulp.series('less', 'rtl'));
	gulp.watch('src/js/**/*.js', gulp.series('babel'));
});

gulp.task('wl', function() {
	gulp.watch('src/less/**/*.less', gulp.series('less'));
});

gulp.task('run', gulp.parallel('less','babel','pot','rtl'));
gulp.task('build', gulp.series('run','clean','zip'));

gulp.task('default', gulp.series('run','watch'));