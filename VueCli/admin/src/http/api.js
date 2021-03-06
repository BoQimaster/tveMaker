import axios from "axios";

export function getYZ(url) {
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

export function post(url, data) {
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
