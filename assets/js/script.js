$(function () {
  var pull = $('#pull') // Variabel tombol navigasi (akan muncul hanya pada perangkat mobile)
  menu = $('nav ul') // Variabel menu

  $(pull).on('click', function (e) {
    e.preventDefault()
    menu.slideToggle()
  })
  $(window).resize(function () {
    var w = $(window).width()
    if (w > 815 && menu.is(':hidden')) {
      menu.removeAttr('style')
    }
  })
})

function currentNav(navId) {
  var current = window.location.href.split('#')[0],
    nav = document.getElementById(navId),
    navItem = nav.getElementsByTagName('a')
  for (var i = 0; i < navItem.length; i++) {
    if (navItem[i].href == current || navItem[i].href == decodeURIComponent(current)) {
      navItem[i].className = 'active'
    }
  }
}
currentNav('navigation')
