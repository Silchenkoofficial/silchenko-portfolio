function getCookie(name) {
   var matches = document.cookie.match(new RegExp('(?:^|\s)' + name + '=(.*?)(?:;|$)'));
   return matches[1];
}

if (!getCookie('logged_in') || getCookie('logged_in') == 'no') {
   alert('Нет куки!');
}

if (document.querySelector('.oauth-btn')) {
   document.addEventListener('click', function () {
      document.cookie = "logged_in=yes";
   });
}