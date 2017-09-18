var exec = require('child_process').execSync('php artisan mixable:manifest');
const mix = require('./mixable-manifest.js');
module.exports = mix;
