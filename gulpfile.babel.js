const {series, parallel, watch, src, dest} = require('gulp');
const fs = require('fs');
const sass = require('gulp-sass');
const babel = require('gulp-babel');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
sass.compiler = require('sass');

const themePath = 'wp-content/themes/norwalk/';
const jsPath = themePath + 'js/';
const sassPath = themePath + 'sass/';
const cssPath = themePath + 'stylesheets/';
const cssRegex = /.*\.css$/;
const jsMinRegex = /.*\.min\.js$/;

const cleanJS = (cb) => {
	fs.readdirSync(jsPath + 'min/')
		.filter(f => jsMinRegex.test(f))
		.map(f => fs.unlinkSync(jsPath + 'min/' + f));
	cb();
}

const cleanCSS = (cb) => {
	fs.readdirSync(cssPath)
		.filter(f => cssRegex.test(f))
		.map(f => fs.unlinkSync(cssPath + f))
	fs.readdirSync(cssPath + 'maps/')
		.map(f => fs.unlinkSync(cssPath + 'maps/' + f));
	fs.rmdirSync(cssPath + 'maps');
	cb();
}

const developSass = (dev = false) => src(sassPath + '*.scss')
	.pipe(sourcemaps.init())
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(sourcemaps.write('./maps'))
	.pipe(dest(cssPath));

const developJS = (dev = false) => src(jsPath + '*.js')
	.pipe(sourcemaps.init())
	.pipe(babel())
	.pipe(sourcemaps.write('./maps'))
	.pipe(rename({extname: '.min.js'}))
	.pipe(dest(jsPath + 'min/'));

exports.develop = () => {
	watch(sassPath + '*.scss', developSass);
	watch(jsPath + '*.js', developJS);
};

const compileJS = (dev = false) => src(jsPath + '*.js')
	.pipe(babel())
	.pipe(rename({extname: '.min.js'}))
	.pipe(dest(jsPath + 'min/'));

const compileSass = (dev = false) => src(sassPath + '*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(dest(cssPath));

exports.sass = series(cleanCSS, compileSass);
exports.js = series(cleanJS,  compileJS);
exports.build = series(
		cleanJS,
		cleanCSS,
		parallel(
			compileSass,
			compileJS
		)
	);
