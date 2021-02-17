module.exports = {
    devServer: {
        proxy: {
            '/captcha': {
                target: 'http://admin.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/captcha': '/captcha'
                }
            },
            '/admin.php/login': {
                target: 'http://admin.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/admin.php/login': '/admin.php/login'
                }
            },
            '/admin.php/login_check': {
                target: 'http://admin.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/admin.php/login_check': '/admin.php/login_check'
                }
            }
        }
    }
}