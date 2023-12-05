var username_hash;
var password_hash;

function getData(form) {
   var formData = new FormData(form);
   for (var pair of formData.entries()) {

    if (pair[0] === "uname") {
       username_hash = md5(pair[1]);
     } else if (pair[0] === "psw") {
       password_hash = md5(pair[1]);
     }
   }

  // Reset the form
   form.reset();
}

function show_result(output, stat){
    document.getElementById("result").innerHTML = output;

    if (stat === 1){
         document.getElementById("result").style.color = "green";
    }
    else {
         document.getElementById("result").style.color = "red";
    }


}

function setCookie(cname,cvalue,exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function challenge_one() {
  if (username_hash === "aae039d6aa239cfc121357a825210fa3" && password_hash === "395363561ee047df818b8d93fd7dec08") {
     show_result("Challenge 1 completed", 1);
     setCookie("mission_1", 1, 30);
     check_missions()
   }
   else {
     show_result("Username or password is incorrect", 0);
   }
}



function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
}

function check_missions() {
for (let i = 1; i <= 5; i++) {
  let mission = getCookie(`mission_${i}`);

  if (mission == 1) {
    img = document.getElementById(`${i}`);
    img.src = "../img/check_box.png";
    x = 30;
    img.width = x;
    img.height = x;
  }
}
}


