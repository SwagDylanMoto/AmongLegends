import { AbstractPage } from './abstract.js';
import { api } from '../api.js';

class EndStatPage extends AbstractPage {

    constructor() {
        super();
    }

    process() {
        this.contentDiv.innerHTML = '';

        const container = document.createElement('div');
        container.className = 'endStat-normal-page';

        const img = document.createElement('img');
        img.src = './resources/img/spongebob.png';
        container.appendChild(img);

        const text = document.createElement('p');
        text.innerHTML = 'L\'administrateur de la partie est entrain de remplir les ' +
            'statistiques de fin de partie.</br>' +
            ' Va te faire foutre et attend un peu, merci.';
        container.appendChild(text);

        this.contentDiv.appendChild(container);
    }

    adminProcess(data) {
        this.contentDiv.innerHTML = '';

        const container = document.createElement('div');
        container.className = 'endStat-admin-page';

        const form = document.createElement('form');
        form.className = 'endStat-form';
        form.method = 'post';
        form.action = '';

        const title = document.createElement('p');
        title.className = 'title';
        title.innerHTML = 'Renseigne les statistiques de fin de partie.';
        form.appendChild(title);

        const selectWinLabel = document.createElement('label');
        selectWinLabel.setAttribute('for', 'select-win');
        selectWinLabel.innerHTML = 'Victoire :';
        const selectWin = document.createElement('select');
        selectWin.id = 'select-win';
        selectWin.name = 'select-win';
        selectWin.required = true;
        const selectWinOptions = [
            {value: '', display: 'Choisir'},
            {value: true, display: 'Oui'},
            {value: false, display: 'Non'}
        ];
        this.addOptions(selectWin, selectWinOptions)
        form.appendChild(selectWinLabel);
        form.appendChild(selectWin);

        const selectOptions = [
            {value: '', display: 'Choisir'}
        ];
        data.userList.forEach(user => {
            selectOptions.push({
                value: user.gs_id,
                display: user.nickname
            });
        });

        const selectKillLabel = document.createElement('label');
        selectKillLabel.setAttribute('for', 'select-kill');
        selectKillLabel.innerHTML = 'Joueur avec le plus de <span class="highlight">kills</span> :';
        const selectKill = document.createElement('select');
        selectKill.id = 'select-kill';
        selectKill.name = 'select-kill';
        selectKill.required = true;
        this.addOptions(selectKill, selectOptions);
        form.appendChild(selectKillLabel);
        form.appendChild(selectKill);

        const selectDeathLabel = document.createElement('label');
        selectDeathLabel.setAttribute('for', 'select-death');
        selectDeathLabel.innerHTML = 'Joueur avec le plus de <span class="highlight">morts</span> :';
        const selectDeath = document.createElement('select');
        selectDeath.id = 'select-death';
        selectDeath.name = 'select-death';
        selectDeath.required = true;
        this.addOptions(selectDeath, selectOptions);
        form.appendChild(selectDeathLabel);
        form.appendChild(selectDeath);

        const selectDmgLabel = document.createElement('label');
        selectDmgLabel.setAttribute('for', 'select-dmg');
        selectDmgLabel.innerHTML = 'Joueur avec le plus de <span class="highlight">dégâts</span> :';
        const selectDmg = document.createElement('select');
        selectDmg.id = 'select-dmg';
        selectDmg.name = 'select-dmg';
        selectDmg.required = true;
        this.addOptions(selectDmg, selectOptions);
        form.appendChild(selectDmgLabel);
        form.appendChild(selectDmg);

        const submit = document.createElement('input');
        submit.className = 'button';
        submit.type = 'submit';
        submit.value = 'C\'est bon !';
        form.appendChild(submit);

        container.appendChild(form);

        this.contentDiv.appendChild(container);
    }

    addOptions(selectEl, options) {
        options.forEach(option => {
            const optionEl = document.createElement('option');
            optionEl.value = option.value;
            optionEl.appendChild(document.createTextNode(option.display));
            selectEl.appendChild(optionEl);
        });
    }
}

export const endStatPage = new EndStatPage();