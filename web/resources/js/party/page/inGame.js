import { AbstractPage } from './abstract.js';
import { api } from '../api.js';
import { roles } from "../roles.js";

class InGamePage extends AbstractPage {

    constructor() {
        super();
    }

    process(data) {
        this.contentDiv.innerHTML = '';

        const roleData = roles[data.role];
        if (data.roleAddInfos?.startsWith('##')) {
            roleData.description = roleData.description2;
            data.roleAddInfos = data.roleAddInfos.substring(2);
        }
        roleData.description = roleData.description
            .replace('###', this.translateAddInfos(data.roleAddInfos))
            .replace('###', this.translateAddInfos(data.roleAddInfos));

        const roleContainer = document.createElement('div');
        roleContainer.className = 'role-page';


        const roleContainerHeader = document.createElement('div');
        roleContainerHeader.className = 'role-header';

        const roleContainerImg = document.createElement('img');
        roleContainerImg.className = 'role-header-img';
        roleContainerImg.src = roleData.img;
        roleContainerHeader.appendChild(roleContainerImg);

        const roleContainerTitleContainer = document.createElement('div');
        roleContainerTitleContainer.className = 'role-header-text';
        const roleContainerTitle = document.createElement('p');
        roleContainerTitle.className = 'role-header-text-title';
        roleContainerTitle.appendChild(document.createTextNode(roleData.title));
        roleContainerTitleContainer.appendChild(roleContainerTitle);
        const roleContainerSubtitle = document.createElement('p');
        roleContainerSubtitle.className = 'role-header-text-subtitle';
        roleContainerSubtitle.appendChild(document.createTextNode(roleData.subtitle));
        roleContainerTitleContainer.appendChild(roleContainerSubtitle);
        roleContainerHeader.appendChild(roleContainerTitleContainer);

        roleContainer.appendChild(roleContainerHeader);


        const roleContainerContent = document.createElement('div');
        roleContainerContent.className = 'role-description';

        const roleContainerContentDescription = document.createElement('p');
        roleContainerContentDescription.innerHTML = roleData.description;
        roleContainerContent.appendChild(roleContainerContentDescription);

        roleContainer.appendChild(roleContainerContent);

        if (this.session.admin === 'true') {
            const endGameContainer = document.createElement('div');
            endGameContainer.className = 'role-end-game';

            const endGameButton = document.createElement('button');
            endGameButton.className = 'button';
            endGameButton.onclick = endGame;
            endGameButton.appendChild(document.createTextNode('Partie finie !'));
            endGameContainer.appendChild(endGameButton);

            roleContainer.appendChild(endGameContainer);
        }

        this.contentDiv.appendChild(roleContainer);
    }

    translateAddInfos(addInfos) {
        switch(addInfos){
            case 'Toplaner':
                return 'le toplaner ennemi';
            case 'Jungler':
                return 'le jungler ennemi';
            case 'Midlaner':
                return 'le midlaner ennemi';
            case 'Adc':
                return 'l\'adc ennemi';
            case 'Support':
                return 'le support ennemi';
            case 'YourLaner':
                return 'ton laner ennemi';
            default:
                return addInfos;
        }
    }
}

function endGame(e) {
    api.finishGame();
    e.target.disabled = true;
}

export const inGamePage = new InGamePage();