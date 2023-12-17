let notifications = document.querySelector('.notifications');
let support = document.getElementById('support');
let dgb = document.getElementsByClassName('isauthed');
function createToast(type, icon, title, text) {
    let newToast = document.createElement('div');
    newToast.innerHTML = `
            <div class="toast ${type}">
                <i class="${icon}"></i>
                <div class="content">
                    <div class="title">${title}</div>
                    <span>${text}</span>
                </div>
            </div>`;
    notifications.appendChild(newToast);
    newToast.timeOut = setTimeout(
        () => newToast.remove(), 2000
    )
}

support.onclick = function () {
    let type = 'warning';
    let icon = 'fa-solid fa-triangle-exclamation';
    let title = '現在非公開です';
    let text = '';
    createToast(type, icon, title, text);
}


window.onload = function(){
    if(!dgb) return;
    switch(dgb[0].id){
        case 'authed':
            createToast('success','fa-solid fa-circle-check','認証が完了しました','created by NICO57');
            break;
        case 'noauthed':
            createToast('error','fa-solid fa-circle-exclamation','認証に失敗しました','もう一度認証をしてください');
            break;
        case '':
            createToast('error','fa-solid fa-circle-exclamation','認証に失敗しました','もう一度認証をしてください');
            break;
    }
}
/*

success fa-solid fa-circle-check
error fa-solid fa-circle-exclamation
warning fa-solid fa-triangle-exclamation
info fa-solid fa-circle-info

*/