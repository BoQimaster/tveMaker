module.exports = {
    devServer: {
        proxy: {
            '/captcha': {
                target: 'http://admin.tvemaker.com',
                changeOrigin: false,
                pathRewrite: {
                    '^/captcha': '/captcha'
                }
            },
            '/login': {
                target: 'http://admin.tvemaker.com',
                changeOrigin: false,
                pathRewrite: {
                    '^/login': '/login'
                }
            },
            '/admin.php/login_check': {
                target: 'http://admin.tvemaker.com',
                changeOrigin: false,
                pathRewrite: {
                    '^/login_check': '/login_check'
                }
            }
        }
    }
}