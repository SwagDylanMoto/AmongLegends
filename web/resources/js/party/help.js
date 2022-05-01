import { roles } from "./roles.js";

function helpInit() {
    const helpSelect = document.getElementById('help-select');
    helpSelect.onchange = updateHelp;
    updateRole(helpSelect.value);
}

function updateHelp(e) {
    updateRole(e.target.value);
}

function updateRole(role) {
    const img = document.getElementById('role-img');
    const title = document.getElementById('role-title');
    const subtitle = document.getElementById('role-subtitle');
    const explication = document.getElementById('role-explication');

    const roleInfos = roles[role];

    if(roleInfos) {
        img.src = roleInfos.img;
        title.innerHTML = roleInfos.title;
        subtitle.innerHTML = roleInfos.subtitle;
        explication.innerHTML = roleInfos.explication;
    } else {
        console.error('Aucune d\'informations sur le rôle ont été trouvé');
    }
}

helpInit();