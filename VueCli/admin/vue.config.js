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
            '/admin/login': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/admin/login': '/admin/login'
                }
            },
            '/admin/check': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/admin/check': '/admin/check'
                }
            },
            '/token': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/token': '/token'
                }
            },
            '/password/search': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/password/search': '/password/search'
                }
            },
            '/password/send': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/password/send': '/password/send'
                }
            },
            '/password/check': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/password/check': '/password/check'
                }
            },
            '/password/reset': {
                target: 'http://api.tvemaker.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/password/reset': '/password/reset'
                }
            },

        }
    }
}