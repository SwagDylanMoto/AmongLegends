import { api } from './api.js';
import { lobbyPage } from './page/lobby.js';
import { inGamePage } from "./page/inGame.js";
import { endStatPage } from "./page/endStat.js";

let status = null;

process();
setInterval(process, 5000);

async function process() {

    const response = await api.refresh();

    switch(response.state) {
        case 'Lobby':
            if (status !== 'Lobby') {
                lobbyPage.process(response.data);
            } else {
                lobbyPage.userList(response.data);
            }
            break;
        case 'InGame':
            if (status !== 'InGame') {
                const responseWithData = await api.refresh(true);
                if (responseWithData.state === 'InGame' && responseWithData.data != null) {
                    inGamePage.process(responseWithData.data);
                }
            }
            break;
        case 'EndStat':
            if (status !== 'EndStat') {
                const admin = document.getElementById("page-content").getAttribute('admin');
                if (admin === 'true') {
                    const responseWithData = await api.refresh(true);
                    if (responseWithData.state === 'EndStat' && responseWithData.data != null) {
                        endStatPage.adminProcess(responseWithData.data);
                    }
                } else {
                    endStatPage.process();
                }
            }
            break;

    }

    status = response.state;
}