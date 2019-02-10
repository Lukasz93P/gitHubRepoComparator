const proxy = require('http-proxy-middleware');

module.exports = function(app) {
    app.use(proxy('/symfony/gitHubRepoComparator/web/app_dev.php',
        { target: 'http://localhost:80', changeOrigin: true}
    ));
};