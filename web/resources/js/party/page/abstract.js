export class AbstractPage {

    contentDiv = document.getElementById("page-content");

    session = {
        nickname: '',
        admin: false
    }

    constructor() {
        this.session.nickname = this.contentDiv.getAttribute('nickname');
        this.session.admin = this.contentDiv.getAttribute('admin');
    }

    process($data) {}
}