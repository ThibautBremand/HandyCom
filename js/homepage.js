$(document).ready(function () {
  $.post('Control/homepage.php', { query: 'retrieveTplCategs' }, function (data) {
    $('#linksmenu').html(data)
  })
  $.post('Control/homepage.php', { query: 'retrieveTplForCateg', categ: 'all' }, function (data) {
    $('#tplResults').html(data)
  })
  if ($(window).width() < 750) {
    $('.bigtitle').css('font-size', '24px')
  }
})

function retrieveTplCategs (categSelected, url) {
  $.post('Control/homepage.php', { query: 'retrieveTplForCateg', categ: categSelected }, function (data) {
    $('#tplResults').html(data)
    /* alert ( url.value ) ;
    var ulLinks = getByClass("linkTpl");
    for ( var i = 0; i < ulLinks.length; ++i ) {
      ulLinks[i].style.background = "#ffffff";
      ulLinks[i].style.color = "#666666";
      ulLinks[i].style.border = "1px solid #cacaca";
    } */
  })
}

function previewTplFancybox (template) {
  // Builds the content
  $.post('Control/homepage.php', { query: 'retrieveTpl', tpl: template }, function (data) {
    jQuery.colorbox({html: data, width: '80%', height: '70%'})
  })
}

function loadInscription () {
  var formInscription = ''
  formInscription = '<p><h1>Inscription :</h1></p>' +
                '<form id="inscriptionForm" class="" style="margin-right:3%;" method="POST" role="form" onsubmit="return registerPerson()">' +
                '<li style="list-style-types:none">' +
                  '<ul class="">' +
                    'Login : <input class="form-control" type="text" name="login" placeholder="Login">' +
                  '</ul>' +
                  '<ul class="">' +
                    'Password (it will be encrypted) : <input class="form-control" type="password" name="password" placeholder="Password">' +
                  '</ul>' +
                  '<ul class="">' +
                    'Email : <input class="form-control" type="text" name="mail" placeholder="Adresse mail">' +
                  '</ul>' +
                '<li>' +
                  '<button class="btn btnconnect" type="submit">OK</button>' +
                '</form>'

  jQuery.colorbox({html: formInscription, width: '80%', height: '70%'})
}

function registerPerson () {
  if (document.forms['inscriptionForm']['login'].value == '') {
    alert('Please type your login !')
    return false
  }
  if (document.forms['inscriptionForm']['password'].value == '') {
    alert('Please type your password !')
    return false
  }
  if (document.forms['inscriptionForm']['mail'].value == '') {
    alert('Please type your email !')
    return false
  }

  // All the fields are filled, we can submit the registration request
  $.post('Control/homepage.php', { query: 'registerPerson', login: document.forms['inscriptionForm']['login'].value, password: document.forms['inscriptionForm']['password'].value, mail: document.forms['inscriptionForm']['mail'].value }, function (data) {
    if (data == 'ok') {
      alert('You can now connect to your account !')
      $.colorbox.close()
      return true
    } else {
      alert('Sorry, this login is already taken !')
    }
  })
  return false
}

// When a user logs in from the homepage form
function logUser () {
  if (document.forms['loginForm']['login'].value == '') {
    alert('lease type your login !')
    return false
  }
  if (document.forms['loginForm']['password'].value == '') {
    alert('Please type your password !')
    return false
  }

  // All the fields are filled, we can submit the login request
  $.post('Model/connectionChecker.php', { login: document.forms['loginForm']['login'].value, password: document.forms['loginForm']['password'].value }, function (data) {
    /* if ( data == "ok" ) {
      alert ( "L'inscription s'est correctement déroulée, vous pouvez vous connecter !");
    } */
    if (data == '') {
      return true
    } else {  // Wrong password
      return false
    }
  })
}

function decoUser () {
  // $.get("deconnexion.php");
  // location.reload();
}

/** *UTIL***/
// Gets all the elements for a certain class
function getByClass (className) {
  if (document.getElementsByClassName) {
    var elements = document.getElementsByClassName(className)
  } else {
    var elements = Array()
    for (var i = 0; i < document.all.length; i++) {
      var elementClass = document.all(i).className.split(/\s/)
      for (var r = 0; r < elementClass.length; r++) {
        if (elementClass[r] == className) {
          elements.push(document.all(i))
        };
      };
    };
  };
  if (elements.length > 0) { return elements } else { return false };
};
