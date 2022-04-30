import { AbstractPage } from './abstract.js';
import { insulte } from "../../insulte.js";
import { baseUrl } from "../../config.js";

class VotedPage extends AbstractPage {

    constructor() {
        super();
    }

    process(data) {
        this.contentDiv.innerHTML = '';

        const container = document.createElement('div');
        container.className = 'voted-page';

        const title = document.createElement('p');
        title.className = 'title';
        title.innerHTML = 'Tu as voté !.';
        container.appendChild(title);

        const img = document.createElement('img');
        img.src = baseUrl + '/resources/img/spongebob.png';
        container.appendChild(img);

        const text = document.createElement('p');
        text.className = 'description';
        text.innerHTML = 'Tout le monde n\'a pas encore voté.</br>' +
            'Tu dois attendre <span class="highlight" id="people-left"></span> fils de putes:';
        container.appendChild(text);

        const peoples = document.createElement('div');
        peoples.className = 'people-list';
        peoples.id = 'people-list';
        container.appendChild(peoples);

        this.contentDiv.appendChild(container);

        this.peopleLeft(data);
    }

    peopleLeft(data) {
        const peopleLeft = document.getElementById('people-left');
        peopleLeft.innerHTML = data.peopleLeft.length.toString();

        const peopleLeftList = document.getElementById('people-list');

        let toRemoveList = [];
        for (let i = 0; i < peopleLeftList.children.length; i++) {
            let match = false;
            data.peopleLeft.forEach(nickname => {
                if (peopleLeftList.children[i].id === 'people-'+nickname) {
                    match = true;
                }
            });
            if (!match) {
                toRemoveList.push(peopleLeftList.children[i]);
            }
        }
        toRemoveList.forEach(child => {
            peopleLeftList.removeChild(child);
        })

        data.peopleLeft.forEach(nickname => {
            if (!document.getElementById('people-'+nickname)) {
                const newPeopleElement = document.createElement('p');
                newPeopleElement.id = 'people-'+nickname;
                newPeopleElement.innerHTML =
                    '<span class="highlight">' + nickname + '</span> '
                    + insulte[Math.floor(Math.random() * insulte.length)];
                peopleLeftList.appendChild(newPeopleElement);
            }
        });
    }
}

export const votedPage = new VotedPage();