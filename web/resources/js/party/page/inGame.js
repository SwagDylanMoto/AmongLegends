import { AbstractPage } from './abstract.js';
import { api } from '../api.js';

class InGamePage extends AbstractPage {

    constructor() {
        super();
    }

    process(data) {
        this.contentDiv.innerHTML = '';

        const roleData = this.roles[data.role];
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
                return 'le toplaner ennemis';
            case 'Jungler':
                return 'le jungler ennemis';
            case 'Midlaner':
                return 'le midlaner ennemis';
            case 'Adc':
                return 'l\'adc ennemis';
            case 'Support':
                return 'le support ennemis';
            case 'YourLaner':
                return 'ton laner ennemis';
            default:
                return addInfos;
        }
    }

    roles = {
        Gay: {
            img: './resources/img/roles/Gay.png',
            title: 'Gay',
            subtitle: 'Roméo',
            description: 'Tu es aveuglé par l\'amour (super gay) que tu ressens pour <span class="highlight">###</span> .' +
                ' Tu dois gagner la partie sans prendre un seul kill à ton amour,' +
                ' et en mourant pour lui à chaque fois que lui meurt.',
            description2: 'Tu es aveuglé par l\'amour (super gay) que tu ressens pour <span class="highlight">###</span> .' +
                ' Tu dois gagner la partie sans jamais tuer ton amour,' +
                ' et en mourant pour lui à chaque fois que lui meurt.'
        },

        Krik: {
            img: './resources/img/roles/Krik.png',
            title: 'Krik',
            subtitle: 'Escroc',
            description: 'Tel un gnar lethalité ou un varus tank,' +
                ' ton but est de te faire voter comme imposteur (sussy baka) mais surtout sans perdre.',
            description2: ''
        },

        Ratio: {
            img: './resources/img/roles/Ratio.png',
            title: 'Ratio',
            subtitle: 'Serpentin',
            description: 'Tu es là pour la BAGAARRRE en mode RATIOOOO !!!' +
                ' Ton objectif est d\'avoir le plus de kills, morts et dégats tout en gagnant.',
            description2: ''
        },

        Sasuke: {
            img: './resources/img/roles/Sasuke.png',
            title: 'Sasuke',
            subtitle: 'Trop dark',
            description: 'Tu n\'as pas d\'amis ni de passion, ton seul objectif et de tuer ' +
                '<span class="highlight">###</span> pour ton venger clan.' +
                ' Tu dois gagner la partie en focusant uniquement <span class="highlight">###</span>.' +
                ' Tu tues les autres ennemis seulement si ta cible est déjà morte ou qu\'un ennemis te bloque.',
            description2: ''
        },

        SussyBaka: {
            img: './resources/img/roles/SussyBaka.png',
            title: 'Sussy Baka',
            subtitle: 'Imposteur',
            description: 'Uh oh !! Ton but est de perdre mais sans te faire voter imposteur (Sussy Baka). Bonne chance.',
            description2: ''
        }
    }
}

function endGame(e) {
    api.finishGame();
}

export const inGamePage = new InGamePage();