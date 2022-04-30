import { baseUrl } from "../config.js";

export const roles = {
        Gay: {
            img: baseUrl+'/resources/img/roles/Gay.png',
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
            img: baseUrl+'/resources/img/roles/Krik.png',
            title: 'Krik',
            subtitle: 'Escroc',
            description: 'Tel un gnar lethalité ou un varus tank,' +
                ' ton but est de te faire voter comme imposteur (sussy baka) mais surtout sans perdre.',
            description2: ''
        },

        Ratio: {
            img: baseUrl+'/resources/img/roles/Ratio.png',
            title: 'Ratio',
            subtitle: 'Serpentin',
            description: 'Tu es là pour la BAGAARRRE en mode RATIOOOO !!!' +
                ' Ton objectif est d\'avoir le plus de kills, morts et dégats tout en gagnant.',
            description2: ''
        },

        Sasuke: {
            img: baseUrl+'/resources/img/roles/Sasuke.png',
            title: 'Sasuke',
            subtitle: 'Trop dark',
            description: 'Tu n\'as pas d\'amis ni de passion, ton seul objectif et de tuer ' +
                '<span class="highlight">###</span> pour ton venger clan.' +
                ' Tu dois gagner la partie en focusant uniquement <span class="highlight">###</span>.' +
                ' Tu tues les autres ennemis seulement si ta cible est déjà morte ou qu\'un ennemis te bloque.',
            description2: ''
        },

        SussyBaka: {
            img: baseUrl+'/resources/img/roles/SussyBaka.png',
            title: 'Sussy Baka',
            subtitle: 'Imposteur',
            description: 'Uh oh !! Ton but est de perdre mais sans te faire voter imposteur (Sussy Baka). Bonne chance.',
            description2: ''
        }
    }