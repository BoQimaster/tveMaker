
export function setCookie(key, value, days, path) {
    const d = new Date()
    d.setTime(d.getTime() + (days*24*60*60*1000))
    const expires = 'expires=' + d.toUTCString()
    document.cookie = key + '=' + value + ';' + expires + ';path=' + path + ';'
}

export function getCookie(key) {
    const name = key + "="
    const decodedCookie = decodeURIComponent(document.cookie)
    let ca = decodedCookie.split(';')
    for(let i=0; i < ca.length; i++) {
        let c = ca[i].trim()
        if (c.indexOf(name) === 0) return c.substring(name.length, c.length)
    }
    return ""
}

export function checkCookie(key) {
    const userData = getCookie(key)
    if (userData !== '') {
        return true
    } else {
        return false
    }
}

export function logout(key) {
    sessionStorage.removeItem(key)
    const removeTime = new Date()
    document.cookie = key + '=; expires=' + removeTime.getTime() + ';'
}