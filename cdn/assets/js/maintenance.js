var countDownDate = new Date("Oct 29, 2021 19:00:00").getTime();
var myfunc = setInterval(function() {
var now = new Date().getTime();
var timeleft = countDownDate - now;
var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
document.getElementById("days").innerHTML = days +" dias"
document.getElementById("hours").innerHTML = hours + " horas "
document.getElementById("mins").innerHTML = minutes + " minutos "
document.getElementById("secs").innerHTML = seconds + " segundos "
if (timeleft < 0) {
clearInterval(myfunc);
document.getElementById("days").innerHTML = ""
document.getElementById("hours").innerHTML = "" 
document.getElementById("mins").innerHTML = ""
document.getElementById("secs").innerHTML = ""
document.getElementById("counter-main").innerHTML = '';
document.remove();
}
}, 10);
