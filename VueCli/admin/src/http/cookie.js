
export function setCookie(key, value, days, path) {
    const d = new Date()
    d.setTime(d.getTime() + (days*24*60*60*1000))
    const expires = 'expires=' + d.toUTCString()
    return document.cookie = key + '=' + value + ';' + expires + ';patch=' + path + ';secure'
}

export function getCookie(key) {
    const name = key + "="
    const decodedCookie = decodeURIComponent(document.cookie)
    let ca = decodedCookie.split(';')
    for(let i=0; i < ca.length; i++) {
        let c = ca[i]
        while (c.charAt(0) === "") {
            c = c.substring(1)
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length)
        }
    }
    return false
}

export function checkCookie(key) {
    function get(value) {
        const name = value + "="
        const decodedCookies = decodeURIComponent(document.cookie)
        let ca = decodedCookies.split(';')
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === "") {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }

        return false
    }

    const userData = get(key)
    return !!userData
}