import { api } from './api.js';
import { lobbyPage } from './page/lobby.js';

let status = null;

setInterval(process, 5000);

async function process() {

    const response = await api.refresh();

    status = response.state;

    switch(status) {
        case 'Lobby':
            lobbyPage.process(response.data);
            break;
    }
}