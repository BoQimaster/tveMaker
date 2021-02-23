import axios from "axios";

export function getCaptcha(url) {
    return new Promise((resolve, reject) => {
        axios({
            method: 'get',
            url: url,
            responseType: 'arraybuffer'
        }).then(res => {
            resolve ('data:image/png;base64,' + btoa(new Uint8Array(res.data).reduce((data, byte) => data + String.fromCharCode(byte), '')))
        }).catch(err => {
            reject(err.data)
        })
    })
}

export function upload(url, data) {
    return new Promise((resolve, reject) => {
        axios({
            method: 'post',
            url: url,
            data: data,
            responseType: 'json',
        }).then(res => {
            resolve (res.data)
        }).catch(err => {
            reject(err.data)
        })
    })
}

export function login(url, data) {
    return new Promise((resolve, reject) => {
        axios({
            method: 'post',
            url: url,
            data: data,
            responseType: 'json',
        }).then(res => {
            resolve (res.data)
        }).catch(err => {
            reject(err.data)
        })
    })
}