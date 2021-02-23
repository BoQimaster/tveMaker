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
            '/upload': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/upload': '/upload'
                }
            },
            '/login_check': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/login_check': '/login_check'
                }
            }
        }
    }
}