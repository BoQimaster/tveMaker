module.exports = {
    devServer: {

        proxy: {
            '/captcha': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/captcha': '/captcha'
                }
            },
            '/admin_upload': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/admin_upload': '/admin_upload'
                }
            },
            '/login_check': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/login_check': '/login_check'
                }
            },
            '/token': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/token': '/token'
                }
            }
        }
    }
}