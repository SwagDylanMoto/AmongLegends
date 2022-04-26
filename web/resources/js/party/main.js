import { api } from './api.js';
import { lobbyPage } from './page/lobby.js';
import { inGamePage } from "./page/inGame.js";

let status = null;

process();
setInterval(process, 5000);

async function process() {

    const response = await api.refresh();

    switch(response.state) {
        case 'Lobby':
            lobbyPage.process(response.data);
            break;
        case 'InGame':
            if (status !== 'InGame') {
                const responseWithData = await api.refresh(true);
                if (responseWithData.status === 'InGame' && responseWithData.data != null) {
                    inGamePage.process(responseWithData.data);
                }
            }
            break;
    }

    status = response.state;
}