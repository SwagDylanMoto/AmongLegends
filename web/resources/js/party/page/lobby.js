import { AbstractPage } from './abstract.js';
import { api } from '../api.js';

class LobbyPage extends AbstractPage {

    constructor() {
        super();
    }

    process(data) {
        this.contentDiv.innerHTML = '';

        const header = document.createElement('p');
        header.appendChild(document.createTextNode('Liste des utilisateurs:'));

        this.contentDiv.appendChild(header);

        const userContainer = document.createElement('div');

        data.userList.forEach( user => {
                const newEl = document.createElement('p');
                newEl.appendChild(document.createTextNode(user.points + ' pts - ' + user.nickname + (user.admin != 0 ? ' - Admin' : '')));

                if (this.session.admin === 'true' && user.id && user.nickname !== this.session.nickname) {
                    const kickButton = document.createElement('button');
                    kickButton.setAttribute('sessionId', user.id);
                    kickButton.onclick = kickSession;
                    kickButton.appendChild(document.createTextNode('Kick'));

                    newEl.appendChild(kickButton);
                }

                userContainer.appendChild(newEl);
            }
        );

        this.contentDiv.appendChild(userContainer);

        if (this.session.admin === 'true') {
            const gameContainer = document.createElement('div');

            const startGameButton = document.createElement('button');
            startGameButton.onclick = startGame;
            if (data.userList.length < 5) {
                startGameButton.disabled = true;
            }
            startGameButton.appendChild(document.createTextNode('Start game'));

            gameContainer.appendChild(startGameButton);

            this.contentDiv.appendChild(gameContainer);
        }
    }
}

function kickSession(e) {
    const sessionId = e.target.getAttribute('sessionId');
    api.kickSession(sessionId);
    e.target.disabled = true;
}

function startGame(e) {
    api.startGame();
}

export const lobbyPage = new LobbyPage();