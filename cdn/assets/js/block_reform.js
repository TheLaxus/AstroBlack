
//Bloquear o reenviar formulário
if(window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href)
}