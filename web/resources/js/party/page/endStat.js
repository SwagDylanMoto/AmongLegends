import { AbstractPage } from './abstract.js';
import { api } from '../api.js';

class EndStatPage extends AbstractPage {

    constructor() {
        super();
    }

    process() {
        this.contentDiv.innerHTML = '';

        const container = document.createElement('div');
        container.className = 'endStat-normal-page';

        const img = document.createElement('img');
        img.src = './resources/img/spongebob.png';
        container.appendChild(img);

        const text = document.createElement('p');
        text.innerHTML = 'L\'administrateur de la partie est entrain de remplir les ' +
            'statistiques de fin de partie.</br>' +
            ' Va te faire foutre et attend un peu, merci.';
        container.appendChild(text);

        this.contentDiv.appendChild(container);
    }

    adminProcess(data) {

    }
}

export const endStatPage = new EndStatPage();