import { AbstractPage } from './abstract.js';
import { api } from '../api.js';
import { baseUrl } from "../../config.js";

class LobbyPage extends AbstractPage {

    constructor() {
        super();
    }

    process(data) {
        this.contentDiv.innerHTML = '';

        const container = document.createElement('div');
        container.className = 'lobby-page';

        const header = document.createElement('p');
        header.className = 'title';
        header.appendChild(document.createTextNode('Liste des utilisateurs:'));

        container.appendChild(header);

        const userContainer = document.createElement('div');
        userContainer.className = 'user-list';
        userContainer.id = 'user-list';

        container.appendChild(userContainer);

        if (this.session.admin === 'true') {
            const gameContainer = document.createElement('div');
            gameContainer.id = 'admin-game-container';
            gameContainer.className = 'game';

            container.appendChild(gameContainer);
        }

        this.contentDiv.appendChild(container);

        this.userList(data);
    }

    userList(data) {
        const userList = document.getElementById('user-list');
        userList.innerHTML = '';
        data.userList.forEach( user => {
                const newEl = document.createElement('div');
                let newElClass = 'user';

                if (user.nickname === this.session.nickname) {
                    newElClass += ' you';
                }
                if (user.admin != 0) {
                    newElClass += ' admin';
                    const adminEl = document.createElement('img');
                    adminEl.className = 'admin';
                    adminEl.src = baseUrl + '/resources/img/icon.png';
                    newEl.appendChild(adminEl);
                } else {
                    const adminEl = document.createElement('span');
                    adminEl.className = 'admin';
                    newEl.appendChild(adminEl);
                }

                newEl.className = newElClass;

                const nicknameEl = document.createElement('p');
                nicknameEl.className = 'nickname';
                nicknameEl.appendChild(document.createTextNode(user.nickname));
                newEl.appendChild(nicknameEl);

                const pointsEl = document.createElement('p');
                pointsEl.className = 'points';
                pointsEl.appendChild(document.createTextNode(user.points + ' pts'));
                newEl.appendChild(pointsEl);

                if (this.session.admin === 'true' && user.id && user.nickname !== this.session.nickname) {
                    const kickButton = document.createElement('button');
                    kickButton.className = 'button cancel';
                    kickButton.setAttribute('sessionId', user.id);
                    kickButton.onclick = kickSession;
                    kickButton.appendChild(document.createTextNode('Ratio'));

                    newEl.appendChild(kickButton);
                }
            userList.appendChild(newEl);
        });

        const gameContainer = document.getElementById('admin-game-container');
        if (gameContainer != null) {
            gameContainer.innerHTML = '';

            const startGameButton = document.createElement('button');
            startGameButton.className = 'button';
            startGameButton.onclick = startGame;
            if (data.userList.length < 5) {
                startGameButton.disabled = true;
            }
            startGameButton.appendChild(document.createTextNode('Commencer la partie'));

            gameContainer.appendChild(startGameButton);
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
    e.target.disabled = true;
}

export const lobbyPage = new LobbyPage();