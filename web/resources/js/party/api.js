import { baseUrl } from '../config.js';

class API {

     async refresh(data = false) {
        let url = baseUrl + '/party/api.php';
        if (data) {
            url += '?maxiData=true';
        }
        const xhttp = new XMLHttpRequest();

        xhttp.open('GET', url, false);
        xhttp.send();

        if (xhttp.status === 200) {
            return JSON.parse(xhttp.responseText);
        } else {
            location.reload();
        }

    }

    async kickSession(sessionId) {
        const url = baseUrl + '/party/admin.php?action=kickSession';
        const params = {
            sessionId: sessionId
        }
        await this.post(url, params);
    }

    async startGame() {
        const url = baseUrl + '/party/admin.php?action=startGame';
        const params = {}
        await this.post(url, params);
    }

    async finishGame() {
        const url = baseUrl + '/party/admin.php?action=finishGame';
        const params = {}
        await this.post(url, params);
    }

    async post(url, params) {
        const xhttp = new XMLHttpRequest();

        xhttp.open('POST', url, false);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        let body = '';
        Object.keys(params).forEach(key => {
            body += key + '=' + params[key] + '&';
        });
        body.substring(0, body.length -1);

        xhttp.send(body);

        return xhttp;
    }
}

export const api = new API();