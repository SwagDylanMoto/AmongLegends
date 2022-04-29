import { AbstractPage } from './abstract.js';
import { api } from '../api.js';

class VotedPage extends AbstractPage {

    constructor() {
        super();
    }

    process(data) {
        this.contentDiv.innerHTML = '';

        const container = document.createElement('div');
        container.className = 'voted-page';

        const title = document.createElement('p');
        title.className = 'title';
        title.innerHTML = 'Tu as voté !.';
        container.appendChild(title);

        const img = document.createElement('img');
        img.src = './resources/img/spongebob.png';
        container.appendChild(img);

        const text = document.createElement('p');
        text.className = 'description';
        text.innerHTML = 'Tout le monde n\'a pas encore voté.</br>' +
            'Tu dois attendre <span class="highlight" id="people-left"></span> fils de putes.';
        container.appendChild(text);

        this.contentDiv.appendChild(container);
    }

    peopleLeft(data) {

    }
}

export const votedPage = new VotedPage();