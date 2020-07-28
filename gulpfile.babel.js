const {series, parallel, watch, src, dest} = require('gulp');
const fs = require('fs');
const sass = require('gulp-sass');
const babel = require('gulp-babel');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
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
    try {
        fs.readdirSync(jsPath + 'min/maps/')
            .map(f => fs.unlinkSync(jsPath + 'min/maps/' + f));
        fs.rmdirSync(jsPath + 'min/maps');
    }
    catch(e) {
        console.log('\x1b[33m', 'This is probably just that /maps/ doesn\'t exist, which is fine.', "\x1b[0m");
        console.error(e);
    }
    cb();
};

const cleanCSS = (cb) => {
    fs.readdirSync(cssPath)
        .filter(f => cssRegex.test(f))
        .map(f => fs.unlinkSync(cssPath + f));
    try {
        fs.readdirSync(cssPath + 'maps/')
            .map(f => fs.unlinkSync(cssPath + 'maps/' + f));
        fs.rmdirSync(cssPath + 'maps');
    }
    catch(e) {
        console.log('\x1b[33m', 'This is probably just that /maps/ doesn\'t exist, which is fine.', "\x1b[0m");
        console.error(e);
    }
    cb();
};

const developSass = () => src(sassPath + '*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(sourcemaps.write('./maps'))
    .pipe(dest(cssPath));

const developJS = () => src(jsPath + '*.js')
    .pipe(sourcemaps.init())
    .pipe(babel())
    .pipe(sourcemaps.write('./maps'))
    .pipe(rename({extname: '.min.js'}))
    .pipe(dest(jsPath + 'min/'));

exports.develop = () => {
    watch(sassPath + '*.scss', developSass);
    watch(jsPath + '*.js', developJS);
};

const compileJS = () => src(jsPath + '*.js', {ignore: 'modernizr.*.js'})
    .pipe(babel())
    .pipe(uglify())
    .pipe(rename({extname: '.min.js'}))
    .pipe(dest(jsPath + 'min/'));

const copyModernizr = () => src(jsPath + 'modernizr.*.js')
    .pipe(rename({extname: '.min.js'}))
    .pipe(dest(jsPath + 'min/'));

const compileSass = () => src(sassPath + '*.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(dest(cssPath));

exports.sass = series(cleanCSS, compileSass);
exports.js = series(cleanJS, compileJS);
exports.build = series(
    cleanJS,
    cleanCSS,
    parallel(
        compileSass,
        compileJS,
        copyModernizr
    )
);
