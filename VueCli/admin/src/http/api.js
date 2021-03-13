import axios from "axios";

export function get(url) {
    return new Promise((resolve, reject) => {
        axios({
            method: 'get',
            url: url,
            responseType: 'json'
        }).then(res => {
            resolve(res.data)
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

export function post(url, data, token) {
    return new Promise((resolve, reject) => {
        axios({
            method: 'post',
            url: url,
            data: data,
            headers: { 'Authorization': 'bearer ' + token },
            responseType: 'json',
        }).then(res => {
            resolve (res.data)
        }).catch(err => {
            reject(err)
        })
    })
}


