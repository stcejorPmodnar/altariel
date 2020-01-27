function addSelectedButtonClass(id) {
    var el = document.getElementById(id);
    var classN = el.className;
    var split = classN.split(" ")
    var string = split[1];
    $('.' + string).removeClass( "selected" )
    el.className += " selected";
}

async function moveDiv() {
    document.getElementById('buttonstripTop').classList.add("fadeLeft")
    document.getElementById('buttonstripBottom').classList.add("fadeLeftFromRight");
    document.getElementById('chooseText').classList.add("fadeOut");
    document.getElementById('chooseText2').classList.add("fadeUp");
}

function hasClass(element, className) {
    return (' ' + element.className + ' ').indexOf(' ' + className+ ' ') > -1;
}

function divShow(element) {

    var doc = document.getElementById("buttonstripBottom");
    console.log(doc)
    var selected = 0;

    for (var i = 0; i < doc.childNodes.length; i++) {
        if ( hasClass(doc.childNodes[i], "selected")) {
            selected++
        }
    }

    if ( selected == 0 ) {
        if (element == "end") {
            $("#enduranceInput").addClass("FadeDownShow2")
            document.getElementById("enduranceInput").style.zIndex = "10000";
            document.getElementById("speedInput").style.zIndex = "10";
        }
        else {
            $("#speedInput").addClass("FadeDownShow1")
            document.getElementById("speedInput").style.zIndex = "10000";
            document.getElementById("enduranceInput").style.zIndex = "10";
        }
    }
    else {
        if (element == "end") {
            $("#speedInput").removeClass("FadeDownShow1")
            $("#speedInput").addClass("FadeDownHide1")
            $("#enduranceInput").removeClass("FadeDownHide2")
            $("#enduranceInput").addClass("FadeDownShow2")

            document.getElementById("enduranceInput").style.zIndex = "10000";
            document.getElementById("speedInput").style.zIndex = "10";
        }
        else {

            $("#speedInput").addClass("FadeDownShow1")
            $("#speedInput").removeClass("FadeDownHide1")

            document.getElementById("speedInput").style.zIndex = "10000";
            document.getElementById("enduranceInput").style.zIndex = "10";

            $("#enduranceInput").addClass("FadeDownHide2")
            $("#enduranceInput").removeClass("FadeDownShow2")
        }
    }
}

function checkFilled(arg) {
    value = document.getElementById(arg).value;

    if (value === "") {
        console.log('empty');
        return false;
    }
    else {
        var els = document.getElementsByClassName('selected').length;
        if (els == 2) {
            
            var trans = document.getElementsByClassName('selected')[0].id;
            var focus = document.getElementsByClassName('selected')[1].id;

            if ( focus == "buttonBottom1" ) {
                goalCheckId = "endurance"
            }
            else {
                goalCheckId = "speed"
            }

            var goal = document.getElementById(goalCheckId).value

            document.getElementById('transport_input').value = trans;
            document.getElementById('focus_input').value = focus;
            document.getElementById('goal_input').value = goal;
            return true;

        }
    }
}

function checkStart() {
    var els = document.getElementsByClassName('selected').length;
    if (els == 2) {
        var focusChosen = document.getElementsByClassName('selected')[1].id;
        if (focusChosen == 'buttonBottom1') {
            if (checkFilled('endurance')) {
                return true;
            }
        }
        else {
            if (checkFilled("speed")) {
                return true;
            }
        }
    }
    else {
        return false;
    }
}

function showButton() {
    if (checkStart()) {
        $('#start').addClass("fadeInButton")
        $('#start').removeClass("fadeOutButton")
    }
    else  {
        if ( $('#start').hasClass("fadeInButton") ) {
            $('#start').addClass("fadeOutButton")
            $('#start').removeClass("fadeInButton")
        }
    }
}