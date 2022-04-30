import { AbstractPage } from './abstract.js';
import { api } from '../api.js';

class EndGamePage extends AbstractPage {

    constructor() {
        super();
    }

    process() {
        this.contentDiv.innerHTML = '';

        const container = document.createElement('div');
        container.className = 'endGame-page';

        this.contentDiv.appendChild(container);
    }
}

export const endGamePage = new EndGamePage();