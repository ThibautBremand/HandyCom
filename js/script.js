var nbSections = 1
var tplSel = 'none'

// Calls the zipMaker webservice and generates the download link
function genererLien () {
	// Checks if the user did chose a template
  if (tplSel != 'none') {
		// Builds the sections' titles parameters
    var menu = getByClass('titleSec')
    var menuArr = new Array()
    for (var i = 0; i < menu.length; ++i) {
      menuArr[i] = menu[i].value
    }

		// Builds the sections' texts parameters
    var texte = getByClass('textSec')
    var textArr = new Array()
    for (var i = 0; i < menu.length; ++i) {
      textArr[i] = texte[i].value
      textArr[i] = textArr[i].replace(/\"/g, '&quot;')
    }

    var menuArrStr = JSON.stringify(menuArr)
    var textArrStr = JSON.stringify(textArr)

		// textArrStr = encodeURIComponent(textArrStr);

    $.post('webservices/zipMaker.php', { tpl: tplSel, title: $('#titleTpl').val(), menu: menuArrStr, sections: textArrStr, nbsec: nbSections }, function (data) {
      var lienSite = data.substr(0, data.search('template.zip'))
      $('#linkTpl').html('<a href="' + data + '">Download</a> <br></br> <a href="' + lienSite + 'home.html' + '">Website link</a>')
    })
  } else {
    alert('Select a template.')
  }
}

// When the user sets the number of sections his website will contain
function addSection () {
  nbSections++
	// $("#champsSections").append("<li class=\"sectionform\">Titre section " + nbSections + " : <INPUT TYPE=\"text\" id=\"titles" + nbSections + "\" class=\"titleSec\" VALUE=\"t" + nbSections + "\"> Texte section " + nbSections + " : <textarea TYPE=\"text\" id=\"texts" + nbSections + "\" class=\"textSec\"> " + nbSections + "\' section text here</textarea>") ;

  $('#champsSections').append(
		'<span class="sectionform">' +
			'<p style="color:white;font-size:20px;">Section ' + nbSections + '</p>' +
			'<p><span style="color:white;font-style:italic;">Section title :</span> <INPUT TYPE="text" id="titles' + nbSections + '" VALUE="t' + nbSections + '" class="titleSec"> </p>' +
			'<p><textarea TYPE="text" id="texts' + nbSections + '" class="textSec">' + nbSections + '\' section text here</textarea></p>' +
		'</span>')

  $(document).ready(function () { $('.textSec').cleditor() })
  $('.textSec').css('height', '600px')
}

// When the user removes a section
function removeSection () {
  if (nbSections > 1) {
    nbSections--

    var sections = getByClass('sectionform')
    var nb = sections.length - 1
    sections[nb].remove()
  } else {
    alert('There is only one section left !')
  }
}

// Selects a template to be sent to the server
function selectTemplate (tpl) {
  tplSel = tpl

  var linksPreviewTpl = getByClass('tplSelected')
  for (var i = 0; i < linksPreviewTpl.length; ++i) {
    linksPreviewTpl[i].className = 'tplUnselected'
  }

  var id = 'prev' + tpl
	// document.getElementById(id).className = "tplSelected";
}

// Calls the previewMaker webservice
function loadPreview () {
	// Checks if the user did chose a template
  if (tplSel != 'none') {
		// Builds the sections' titles parameters
    var menu = getByClass('titleSec')
    var menuArr = new Array()
    for (var i = 0; i < menu.length; ++i) {
      menuArr[i] = menu[i].value
    }

		// Builds the sections' texts parameters
    var texte = getByClass('textSec')
    var textArr = new Array()
    for (var i = 0; i < menu.length; ++i) {
      textArr[i] = texte[i].value
      textArr[i] = textArr[i].replace(/\"/g, '&quot;')
    }

    var menuArrStr = JSON.stringify(menuArr)
    var textArrStr = JSON.stringify(textArr)

    var width = $(window).width()
    var height = $(window).height()
    width = width - (width / 5)
    height = height - (height / 3)

    var date = new Date()
    $.post('webservices/previewMaker.php', { tpl: tplSel, title: $('#titleTpl').val(), menu: menuArrStr, sections: textArrStr, nbsec: nbSections, time: date.getTime(), cache: false }, function (data) {
			// document.getElementById("preview").innerHTML='<object type="text/html" data="' + data + '" width="' + width + '" height="' + height + '" ></object>';
      document.getElementById('preview').innerHTML = '<iframe id="previf" src="' + data + '" width="' + width + '" height="' + height + '"></iframe>'

      var rand = Math.floor((Math.random() * 1000000) + 1)
      var iframe = document.getElementById('preview').getElementsByTagName('iframe')[0]
			// iframe.contentWindow.location.reload(true);

			// alert ( document.getElementById('preview').getElementsByTagName("iframe")[0] );
      $.get('webservices/previewDeleter.php')
    })
  } else {
    alert('Select a template.')
  }
}

// Loads a draft for the user
function saveDraft () {
	// Builds the sections' titles parameters
  var menu = getByClass('titleSec')
  var menuArr = new Array()
  for (var i = 0; i < menu.length; ++i) {
    menuArr[i] = menu[i].value
    menuArr[i] = menuArr[i].replace(/\"/g, '&quot;')
  }

	// Retrieves the text from the textareas
  var sectionsText = getByClass('textSec')
  var sectionsArr = new Array()
  for (var i = 0; i < sectionsText.length; ++i) {
    sectionsArr[i] = sectionsText[i].value
    sectionsArr[i] = sectionsArr[i].replace(/\"/g, '&quot;')
  }

  var menuArrStr = JSON.stringify(menuArr)
  var sectionsArr = JSON.stringify(sectionsArr)

  $.post('webservices/draftSaver.php', { tpl: tplSel, title: $('#titleTpl').val(), menu: menuArrStr, sections: sectionsArr, nbsec: nbSections }, function (data) {
		// alert ( data ) ;
  })
}

// Allows the user to chose one of his drafts to load
function chooseDraft () {
  $.get('webservices/userDraftsRetriever.php', function (data) {
    $('#chooseDraft').html(data)
  })
}

// Retrieves the draft selected by the user and loads it into the page
function retrieveDraft (draft) {
  $.post('webservices/draftLoader.php', { draftname: draft.innerHTML }, function (data) {
		// Writes the draft into the page
    var count = (data.match(/SECTIONNUMBER/g) || []).length

    $('#champsSections').html('')
    nbSections = 0
		// Adds the sections needed
		// if ( count > nbSections ) {
		//	var sectionsToAdd = count - nbSections ;
    var sectionsToAdd = count
    for (var i = 0; i < sectionsToAdd; ++i) {
      addSection()
    }
		// }

		// Retrieves the information from the data
    var sectionsTxt = new Array()
    var titlesTxt = new Array()
    var templateSelected = ''
    var title = ''

    var partsArray = data.split(/\n/)
    for (var j = 0; j < partsArray.length; ++j) {
      var words = partsArray[j].split('-HANDYCOMTAGSEPARATOR-')
      words[0] = $.trim(words[0])

      if (words[0] == 'TITLE') {
				// Title chosen by the user
        title = words[1]
      }
      if (words[0] == 'TEMPLATE') {
				// Template selected
        templateSelected = words[1]
      } else if (words[0] == 'TITLENUMBER') {
				// Title category
        titlesTxt.push(words[1])
      }			else if (words[0] == 'SECTIONNUMBER') {
				// Section text
        words[1] = words[1].replace(/<img src=/g, "<img onError=\"this.onerror=null;this.src='./images/erreurimage.jpg';\" src=")
        sectionsTxt.push(words[1])
      }
    }

		// Fills the textareas and all the fields
    $('#titleTpl').val(title)
		// selectTemplate(templateSelected);

    for (var i = 0; i < titlesTxt.length; ++i) {
      var j = i + 1
      if (i <= nbSections) {
        $('#titles' + j).val(titlesTxt[i])
      }			else {
        break
      }
    }

    for (var i = 0; i < sectionsTxt.length; ++i) {
      var j = i + 1
      if (i <= nbSections) {
        $('#texts' + j).html(sectionsTxt[i])
        $('#texts' + j).blur()
      } else {
        break
      }
    }

    loadPreview()
  })
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
