import { AbstractPage} from './abstract.js';

class LobbyPage extends AbstractPage {

    process($data) {
        this.contentDiv.innerHTML = '';

        const header = document.createElement('p');
        header.appendChild(document.createTextNode('Liste des utilisateurs:'));

        this.contentDiv.appendChild(header);

        const userContainer = document.createElement('div');

        $data.userList.forEach( user => {
                const newEl = document.createElement('p');
                newEl.appendChild(document.createTextNode(user.points + ' pts - ' + user.nickname + (user.admin ? ' - Admin' : '')));
                userContainer.appendChild(newEl);
            }
        );

        this.contentDiv.appendChild(userContainer);
    }
}

export const lobbyPage = new LobbyPage();