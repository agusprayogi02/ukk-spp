$(function () {
  var pull = $('#pull') // Variabel tombol navigasi (akan muncul hanya pada perangkat mobile)
  menu = $('nav ul') // Variabel menu

  $(pull).on('click', function (e) {
    e.preventDefault()
    menu.slideToggle()
  })
  $(window).resize(function () {
    var w = $(window).width()
    if (w > 915 && menu.is(':hidden')) {
      menu.removeAttr('style')
    }
  })
})

function currentNav(navId) {
  var page = window.location.href.split('#')[0],
    current = page.split('&')[0],
    nav = document.getElementById(navId),
    navItem = nav.getElementsByClassName('item')

  for (var i = 0; i < navItem.length; i++) {
    if (navItem[i].href == current || navItem[i].href == decodeURIComponent(current)) {
      navItem[i].className = 'active'
    }
  }
}
currentNav('navigation')

// modal
$('.btn').click((e) => {
  $('#' + $(e.target).data('target')).css('display', 'block')
})

$('.close').click((e) => {
  $('#update-modal').css('display', 'none')
  $('#pass-modal').css('display', 'none')
  $('#tambah-modal').css('display', 'none')
})

$(window).click(function (e) {
  if (
    e.target.id == 'update-modal' ||
    e.target.id == 'tambah-modal' ||
    e.target.id == 'pass-modal'
  ) {
    $('#' + e.target.id).css('display', 'none')
  }
})
// end modal
