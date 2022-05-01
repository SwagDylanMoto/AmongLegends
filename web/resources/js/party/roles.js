import { baseUrl } from "../config.js";

export const roles = {
        Gay: {
            img: baseUrl+'/resources/img/roles/Gay.png',
            title: 'Gay',
            subtitle: 'Roméo',
            description: 'Tu es aveuglé par l\'amour (super gay) que tu ressens pour <span class="highlight">###</span> .' +
                ' Tu dois gagner la partie sans prendre un seul kill à ton amour,' +
                ' et en mourant pour lui à chaque fois qu\'il  meurt.',
            description2: 'Tu es aveuglé par l\'amour (super gay) que tu ressens pour <span class="highlight">###</span> .' +
                ' Tu dois gagner la partie sans jamais tuer ton amour,' +
                ' et en mourant pour lui à chaque fois qu\'il meurt.',
            explication: 'Le gay est lié à un ennemi ou allié par l\'amour. ' +
                'Il ne peut pas tuer cet ennemi ou prendre un kill à cet ' +
                'allié mais surtout, il doit mourir à chaque fois que son amour meurt. ' +
                'Le tout en essayant de gagner la partie.'
        },

        Krik: {
            img: baseUrl+'/resources/img/roles/Krik.png',
            title: 'Krik',
            subtitle: 'Escroc',
            description: 'Tel un gnar létalité ou un varus tank,' +
                ' ton but est de te faire voter comme imposteur (sussy baka) mais surtout sans perdre.',
            description2: '',
            explication: 'Le Krik doit se faire passer comme imposteur. ' +
                'Il gagnera des points en se faisant voter \'SussyBaka\'. ' +
                'Bien sûr le tout sans perdre, le Krik perdra beaucoup de points s\'il perd.'
        },

        Ratio: {
            img: baseUrl+'/resources/img/roles/Ratio.png',
            title: 'Ratio',
            subtitle: 'Serpentin',
            description: 'Tu es là pour la BAGAARRRE en mode RATIOOOO !!!' +
                ' Ton objectif est d\'avoir le plus de kills, morts et dégâts tout en gagnant.',
            description2: '',
            explication: 'Le Ratio doit faire la bagarre. Il doit avoir le plus de kills, ' +
                'de morts et de dégâts de l\'équipe. Le tout en essayant de gagner la partie.'
        },

        Sasuke: {
            img: baseUrl+'/resources/img/roles/Sasuke.png',
            title: 'Sasuke',
            subtitle: 'Trop dark',
            description: 'Tu n\'as pas d\'amis ni de passion, ton seul objectif et de tuer ' +
                '<span class="highlight">###</span> pour ton venger clan.' +
                ' Tu dois gagner la partie en te concentrant uniquement <span class="highlight">###</span>.' +
                ' Tu tues les autres ennemis seulement si ta cible est déjà morte ou qu\'un ennemi te bloque.',
            description2: '',
            explication: 'Le Sasuke est lié à un ennemi qui est sa cible. ' +
                'Il doit tuer cet ennemi avant les autres ennemis, ' +
                'tant que sa cible est en vie, le Sasuke est pacifiste avec les autres ennemis. ' +
                'Le tout en essayant de gagner la partie.'
        },

        SussyBaka: {
            img: baseUrl+'/resources/img/roles/SussyBaka.png',
            title: 'Sussy Baka',
            subtitle: 'Imposteur',
            description: 'Uh oh !! Ton but est de perdre sans te faire voter imposteur (Sussy Baka). Bonne chance !',
            description2: '',
            explication: 'Le SussyBaka est l\'imposteur. Il doit perdre la partie, ' +
                'mais sans se faire choper par les autres joueurs. ' +
                'Il perdra des points à chaque fois qu\'il se fera voter SussyBaka.'
        }
    }