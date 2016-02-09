var gulp = require('gulp'); // ローカルgulp
var browserSync = require('browser-sync'); // ローカルサーバ＆ブラウザオートリロード
var ejs = require('gulp-ejs'); // インクルード
var plumber = require('gulp-plumber'); // エラーによる強制停止を防止
var notify  = require('gulp-notify'); // エラー通知
var rename = require('gulp-rename'); // ファイルリネーム
var sourcemaps = require('gulp-sourcemaps'); // ソースマップ
var sass = require('gulp-sass'); // sassコンパイル
var pleeease = require('gulp-pleeease'); // ベンダープレフィックス（＆css圧縮）
var concat = require('gulp-concat'); // css結合
var uglify = require('gulp-uglify'); // js圧縮
var imagemin = require('gulp-imagemin'); // 画像圧縮
var pngquant = require('imagemin-pngquant'); // png圧縮

//ローカルサーバ起動タスク
gulp.task('browser-sync', function() {
    browserSync({
        server: {
            baseDir: './',
            index: 'index.html'
        }
    });
});

//htmlタスク
gulp.task('html', function() {
    return gulp.src('**/*.html')
        .pipe(browserSync.reload({stream:true})); // ブラウザリロード
});

//htmlインクルードタスク
gulp.task('ejs', function() {
    return gulp.src(['dev/**/**.ejs','!' + 'dev/**/_**.ejs'])
        .pipe(plumber({
          errorHandler: notify.onError("Error Image: <%= error.message %>")
        }))
        .pipe(ejs())
        .pipe(gulp.dest('./'))
});

    // ディレクトリが複数になったら使用
    // var folders = ['culture', 'recruite'];
    // for ( var i in folders ) {
    //     gulp.task('sass', function() {

    //         return gulp.src([ 'common/sass/common.scss', folders[i] + '/sass/*.scss'])
    //             .pipe(plumber({
    //               errorHandler: notify.onError("Error Sass: <%= error.message %>")
    //             }))
    //             //.pipe(sourcemaps.init())
    //             .pipe(sass())
    //             .pipe(concat(folders[i] + '.css')) // commonファイルと結合
    //             .pipe(pleeease({
    //                 browsers: ["ie 9", "iOS 7", "Android 4.1"], // 対象ブラウザ
    //                 minifier: true // 圧縮するとsoucemapが使えない
    //             }))
    //             //.pipe(sourcemaps.write('./'))
    //             .pipe(rename({
    //                 suffix: '.min'
    //             }))
    //             .pipe(gulp.dest(folders[i] + '/css')) // 納品用フォルダにcss書き出し
    //             .pipe(browserSync.reload({stream:true})); // ブラウザリロード

    //     });
    // }

//Sassタスク
gulp.task('sass', function() {
    return gulp.src('dev/**/**.scss')
        .pipe(plumber({
          errorHandler: notify.onError("Error Sass: <%= error.message %>")
        }))
        //.pipe(sourcemaps.init())
        .pipe(sass())
        //.pipe(concat('culture.css')) // commonファイルと結合
        .pipe(mediaquery({ log: true }))
        .pipe(pleeease({
            browsers: ["ie 9", "iOS 7", "Android 4.1"], // 対象ブラウザ
            minifier: true // 圧縮するとsoucemapが使えない
        }))
        //.pipe(sourcemaps.write('./'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./')) // 納品用フォルダにcss書き出し
        .pipe(browserSync.reload({stream:true})); // ブラウザリロード
});


// cssタスク
gulp.task('css', function() {
    return gulp.src('**/*.css')
    .pipe(browserSync.reload({stream:true})); // ブラウザリロード
});

// JavaScriptタスク
gulp.task('js', function() {
    return gulp.src('dev/**/**.js')
        .pipe(plumber({
          errorHandler: notify.onError("Error JS: <%= error.message %>")
        }))
        //.pipe(concat('culture.js'))
        .pipe(uglify()) // 圧縮
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./')) // 納品用フォルダに書き出し
        .pipe(browserSync.reload({stream:true})); // ブラウザリロード
});

// imageタスク
gulp.task('img', function() { // 画像圧縮
    return gulp.src('dev/**/*.+(jpg|jpeg|png|gif|svg)')
        .pipe(plumber({
          errorHandler: notify.onError("Error Image: <%= error.message %>")
        }))
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{
                removeViewBox: false
            }],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('./'))
});

// common imageタスク
// gulp.task('common_img', function() { // 画像圧縮
//     return gulp.src( 'dev/common/img/**/*.+(jpg|jpeg|png|gif|svg)' )
//         .pipe(plumber({
//           errorHandler: notify.onError("Error Image: <%= error.message %>")
//         }))
//         .pipe(imagemin({
//             progressive: true,
//             svgoPlugins: [{
//                 removeViewBox: false
//             }],
//             use: [pngquant()]
//         }))
//         .pipe(gulp.dest('common/img'))
// });

//デフォルトタスク（コマンドgulpで勝手に実行される）
gulp.task('default', ['browser-sync', 'html', 'sass', 'js', 'img', 'ejs'], function() {
    gulp.watch(['**/**.html'], ['html']);
    gulp.watch(['dev/**/**.ejs','!' + 'dev/**/_**.ejs'], ['ejs']);
    gulp.watch(['dev/**/**.+(scss|sass)'], ['sass']);
    gulp.watch(['dev/**/**.js'], ['js']);
});
