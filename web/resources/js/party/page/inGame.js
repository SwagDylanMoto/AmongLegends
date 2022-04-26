import { AbstractPage } from './abstract.js';
import { api } from '../api.js';

class InGamePage extends AbstractPage {

    constructor() {
        super();
    }

    process(data) {
        this.contentDiv.innerHTML = '';

        const roleData = this.roles[data.role];
        roleData.description = roleData.description.replace('###', data.roleAddInfos);

        const roleContainer = document.createElement('div');


        const roleContainerHeader = document.createElement('div');

        const roleContainerImg = document.createElement('img');
        roleContainerImg.src = roleData.img;
        roleContainerHeader.appendChild(roleContainerImg);

        const roleContainerTitleContainer = document.createElement('div');
        const roleContainerTitle = document.createElement('p');
        roleContainerTitle.appendChild(document.createTextNode(roleData.title));
        roleContainerTitleContainer.appendChild(roleContainerTitle);
        const roleContainerSubtitle = document.createElement('p');
        roleContainerSubtitle.appendChild(document.createTextNode(roleData.subtitle));
        roleContainerTitleContainer.appendChild(roleContainerSubtitle);
        roleContainerHeader.appendChild(roleContainerTitleContainer);

        roleContainer.appendChild(roleContainerHeader);


        const roleContainerContent = document.createElement('div');

        const roleContainerContentDescription = document.createElement('p');
        roleContainerContentDescription.appendChild(document.createTextNode(roleData.description));
        roleContainerContent.appendChild(roleContainerContentDescription);

        roleContainer.appendChild(roleContainerContent);


        this.contentDiv.appendChild(roleContainer);
    }

    roles = {
        Gay: {
            img: './resources/img/roles/Gay.png',
            title: 'Gay',
            subtitle: 'Roméo',
            description: 'Tu es aveuglé par l\'amour (super gay) que tu ressens pour ### .' +
                ' Tu dois gagner la partie sans prendre un seul kill à ton amour,' +
                ' et en mourant pour lui à chaque fois que lui meurt.'
        },

        Krik: {
            img: './resources/img/roles/Krik.png',
            title: 'Krik',
            subtitle: 'Escroc',
            description: 'Tel un gnar lethalité ou un varus tank,' +
                ' ton but est de te faire voter comme imposteur (sussy baka) mais surtout sans perdre.'
        },

        Ratio: {
            img: './resources/img/roles/Ratio.png',
            title: 'Ratio',
            subtitle: 'Serpentin',
            description: 'Tu es là pour la BAGAARRRE en mode RATIOOOO !!!' +
                ' Tu objectif est d\'avoir le plus de kills, morts et dégats tout en gagnant.'
        },

        Sasuke: {
            img: './resources/img/roles/Sasuke.png',
            title: 'Sasuke',
            subtitle: 'Trop dark',
            description: 'Tu n\'as pas d\'amis ni de passion, ton seul objectif et de tuer ### pour ton clan.' +
                ' Tu dois gagner la partie en focusant ###.' +
                ' Tu tues les autres ennemis seulement si ta cible est déjà morte ou qu\'un ennemis te bloque.'
        },

        SussyBaka: {
            img: './resources/img/roles/SussyBaka.png',
            title: 'Sussy Baka',
            subtitle: 'Imposteur',
            description: 'Uh oh !! Ton rôle est de perdre mais sans se faire voter imposteur (Sussy Baka). Bonne chance.'
        }
    }
}

export const inGamePage = new InGamePage();