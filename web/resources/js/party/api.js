import { baseUrl } from '../config.js';

class API {

     async refresh() {
        const url = baseUrl + '/party/api.php';
        const xhttp = new XMLHttpRequest();

        xhttp.open('GET', url, false);
        xhttp.send();

        return JSON.parse(xhttp.responseText);
    }
}

export const api = new API();