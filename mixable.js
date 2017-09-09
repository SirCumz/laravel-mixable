var exec = require('child_process').execSync('php artisan mixable:manifest');
var fs = require('fs');
const mix = require('laravel-mix');
var manifest = require('./mixable-manifest.js');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management For Modules
 |--------------------------------------------------------------------------
 |
 | Mix Module assets
 | If a module has a mix.js file, it will be compiled into the mix
 |
 */
for(let i = 0; i < manifest.length; i++) {
    require( manifest[i] ).mix( mix );
}

module.exports = mix;