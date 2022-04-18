import { baseUrl } from '../config.js';

class API {

     async refresh() {
        const url = baseUrl + '/party/api.php';
        const xhttp = new XMLHttpRequest();

        xhttp.open('GET', url, false);
        xhttp.send();

        return JSON.parse(xhttp.responseText);
    }

    async kickSession(sessionId) {
        const url = baseUrl + '/party/admin.php?action=kickSession';
        const xhttp = new XMLHttpRequest();

        xhttp.open('POST', url, false);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send('sessionId=' + sessionId);
    }
}

export const api = new API();