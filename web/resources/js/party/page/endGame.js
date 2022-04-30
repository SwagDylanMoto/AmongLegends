import { AbstractPage } from './abstract.js';
import { api } from '../api.js';
import { roles } from "../roles.js";

class EndGamePage extends AbstractPage {

    constructor() {
        super();
    }

    process(data) {
        this.contentDiv.innerHTML = '';

        const container = document.createElement('div');
        container.className = 'endGame-page';

        const title = document.createElement('p');
        title.className = 'title';
        title.innerHTML = 'Voici les scores finaux de la partie :';
        container.appendChild(title);

        const tab = document.createElement('div');
        tab.className = 'score-tab';

        const baseRow = document.createElement('div');
        baseRow.className = 'row base-row';

        const baseImg = document.createElement('p');
        baseImg.className = 'img-col';
        baseImg.innerHTML = 'Rôle';
        baseRow.appendChild(baseImg);

        const basePeople = document.createElement('p');
        basePeople.className = 'people-col';
        basePeople.innerHTML = 'Personne';
        baseRow.appendChild(basePeople);

        const basePts = document.createElement('p');
        basePts.className = 'points-col';
        basePts.innerHTML = 'Points';
        baseRow.appendChild(basePts);

        data.userList.forEach(user => {
            const baseVoting = document.createElement('p');
            baseVoting.className = 'voting-col';
            baseVoting.innerHTML = 'Votes de</br>' + user.nickname;
            baseRow.appendChild(baseVoting);
        });

        tab.appendChild(baseRow);

        data.userList.forEach(user => {
            const row = document.createElement('div');
            row.className = 'row';

            const img = document.createElement('img');
            img.className = 'img-col';
            img.src = roles[user.role].img;
            row.appendChild(img);

            const people = document.createElement('p');
            people.className = 'people-col';
            people.innerHTML = user.nickname;
            row.appendChild(people);

            const pts = document.createElement('p');
            pts.className = 'points-col';
            pts.innerHTML = user.points + ' pts';
            row.appendChild(pts);

            data.userList.forEach(userVoting => {
                const voting = document.createElement('p');
                const roleVoted = userVoting.vote[user.nickname];
                voting.className = 'voting-col';
                if (roleVoted) {
                    voting.innerHTML = roleVoted;
                    if (roleVoted === user.role) {
                        voting.className += ' right';
                    } else if (roleVoted === 'SussyBaka' && user.role === 'Krik') {
                        voting.className += ' uhoh';
                    }
                } else {
                    voting.innerHTML = "";
                    voting.className += ' empty';
                }
                row.appendChild(voting);
            });

            tab.appendChild(row);
        });

        container.appendChild(tab);

        if (this.session.admin === 'true') {
            const newGameContainer = document.createElement('div');
            newGameContainer.className = 'new-game';

            const newGameButton = document.createElement('button');
            newGameButton.className = 'button';
            newGameButton.onclick = newGame;
            newGameButton.appendChild(document.createTextNode('Nouvelle partie !'));
            newGameContainer.appendChild(newGameButton);

            container.appendChild(newGameContainer);
        }

        this.contentDiv.appendChild(container);
    }
}

function newGame(e) {
}

export const endGamePage = new EndGamePage();