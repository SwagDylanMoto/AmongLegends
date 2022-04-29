import { api } from './api.js';
import { lobbyPage } from './page/lobby.js';
import { inGamePage } from "./page/inGame.js";
import { endStatPage } from "./page/endStat.js";
import { votingPage } from "./page/voting.js";
import { votedPage } from "./page/voted.js";

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
        case 'Voting':
            if (status !== 'Voting') {
                const responseWithData = await api.refresh(true);
                if (responseWithData.state === 'Voting' && responseWithData.data != null) {
                    votingPage.process(responseWithData.data);
                }
            }
            break;
        case 'Voted':
            if (status !== 'Voted') {
                votedPage.process(response.data);
            } else {
                votedPage.peopleLeft(response.data);
            }
            break;

    }

    status = response.state;
}