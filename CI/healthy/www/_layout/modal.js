
var story_step = 0;
var stack_deep = 0;

$('a.modal__close').click(function (e) {
    closeModal();
});

$('button.btn').click(function (e) {
    
    var caption = this.innerHTML;

    if (this.parentNode.parentNode.parentNode.classList.contains('modal')) return;
    
    if (caption == 'Close') {
        closeModal();
    }
    else if (caption == 'Open Modal') {
        modalModal();
    }
    else if (caption == 'Open Ajax') {
        modalAjax();
    }
    else if (caption == 'Open Map') {
        modalMap();
    }
    else if (caption == 'Open Video') {
        modalVideo();
    }
    else if (caption == 'Open Form') {
        modalForm();
    }
    else if (caption == 'Open Story') {
        modalStory();
    }
    else if (caption == 'Open Stack') {
        modalStack();
    }
});

$('div.modal__container div.modal__outline section.modal--story form.form footer.modal__foot button.btn').click(function (e) {
    var el = e.target;
    if (el.classList.contains('is--disabled')) return;
    var modal = el.parentNode.parentNode.parentNode;
    var index = parseInt(modal.getAttribute('index'), 10);
    var caption = el.innerHTML;
    if (caption == 'Previous') {
        index--;
    }
    else if (caption == 'Next') {
        index++;
    }
    displayStory(index);
});

$('div.modal__container div.modal__outline section.modal--stack form.form footer.modal__foot button.btn').click(function (e) {
    var el = e.target;
    if (el.classList.contains('is--disabled')) return;
    var modal = el.parentNode.parentNode.parentNode;
    var index = parseInt(modal.getAttribute('index'), 10);
    var caption = el.innerHTML;
    if (caption == 'Close') {
        index--;
        if (index < 1) closeModal();
    }
    else if (caption == 'Open') {
        index++;
    }
    displayStack(index);
});

function modalModal() {
    showModal('normal', 'modal__normal__ajax', '');
}

function modalAjax() {
    showModal('ajax', 'modal__normal__ajax', 'modal__ajax__result');
}

function modalImageLink() {
    showModal('ajax', 'modal__image', '');
}

function modalMap() {
    showModal('map', 'modal__map', 'modal__map__result');
}

function modalVideo() {
    showModal('video', 'modal__video', 'modal__video__result');
}

function modalForm() {
    showModal('form', 'modal__form-single', '');
}

function modalStory() {
    showModal('story', 'modal__form-story', '');
}

function modalStack() {
    showModal('stack', 'modal__form-stack', '');
}

function showModal(type, modalid, infoid) {
    var el = document.getElementById(modalid);
    if (!el.classList.contains('modal__container')) return;
    
    var backdrop = document.getElementById('modal__backdrop');
    backdrop.classList.add('is--open');

    el.classList.add('modal--active');

    if (type == 'ajax') { // for ajax
        ajaxGetInfo(infoid);
    }
    else if (type == 'map') {
        el = document.getElementById(infoid);
        el.innerHTML = "<iframe width='640px' height='480px' frameborder='0' marginheight='0' marginwidth='0' src='https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Newcastle+upon+Tyne&amp;aq=0&amp;oq=newcastl&amp;sll=52.8382,-2.327815&amp;sspn=7.448108,21.643066&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Newcastle+upon+Tyne,+Tyne+and+Wear,+United+Kingdom&amp;ll=54.978402,-1.617737&amp;spn=0.157622,0.411301&amp;z=11&amp;iwloc=A&amp;output=embed'></iframe>";
    }
    else if (type == 'video') {
        el = document.getElementById(infoid);
        el.innerHTML = "<iframe id='video1' width='520' height='360' src='http://www.youtube.com/embed/TJ2X4dFhAC0?enablejsapi' frameborder='0' allowtransparency='true' allowfullscreen></iframe><a href='#' id='playvideo'>Play video</a>";
    }
    else if (type == 'form') {
        ;
    }
    else if (type == 'story') {
        // var count = parseInt(el.getAttribute('count'), 10);
        // if (story_step < 1)
        story_step = 1;
        var sections = document.querySelectorAll('div.modal__container div.modal__outline section.modal--story');
        if (sections.length < 1) return;

        for (var i = 0; i < sections.length; i++) {
            var obj = sections[i];
            var index = parseInt(obj.getAttribute('index'), 10);
            if (index == story_step) {
                obj.style.display = 'block';
            }
            else {
                obj.style.display = 'none';
            }
        }
    }
    else if (type == 'stack') {
        stack_deep = 1;
        var sections = document.querySelectorAll('div.modal__container div.modal__outline section.modal--stack');
        if (sections.length < 1) return;

        for (var i = 0; i < sections.length; i++) {
            var obj = sections[i];
            var index = parseInt(obj.getAttribute('index'), 10);
            if (index == stack_deep) {
                obj.style.display = 'block';
            }
            else {
                obj.style.display = 'none';
            }
        }
    }
}

function closeModal() {
    var backdrop = document.getElementById('modal__backdrop');
    backdrop.classList.remove('is--open');

    var modals = document.querySelectorAll('div.modal__container.modal--active');
    if (modals.length < 1) return;

    for (var i = 0; i < modals.length; i++) {
        var obj = modals[i];
        obj.classList.remove('modal--active');
    }
}

function postFormInfo() {
    var v1, v2;
    el = document.getElementById('input1'); v1 = el.value;
    el = document.getElementById('input2'); v2 = el.value;
    var data = 'v1:' + v1 + ' & ' + 'v2:' + v2;
    ajaxPostInfo(data);
}

function displayStory(newIndex)
{
    var sections = document.querySelectorAll('div.modal__container.modal--active div.modal__outline section.modal--story');
    if (sections.length < 1) return;

    for (var i = 0; i < sections.length; i++) {
        var obj = sections[i];
        var index = parseInt(obj.getAttribute('index'), 10);
        story_step = newIndex;
        if (index == story_step) {
            obj.style.display = 'block';
        }
        else {
            obj.style.display = 'none';
        }
    }
}

function displayStack(deep)
{
    var sections = document.querySelectorAll('div.modal__container.modal--active div.modal__outline section.modal--stack');
    if (sections.length < 1) return;

    for (var i = 0; i < sections.length; i++) {
        var obj = sections[i];
        var index = parseInt(obj.getAttribute('index'), 10);
        stack_deep = deep;
        if (index == stack_deep) {
            obj.style.display = 'block';
        }
        else {
            obj.style.display = 'none';
        }
    }
}

function ajaxGetInfo(id) {
    var el = document.getElementById(id);
    var xmlHttp = null;

    if(window.XMLHttpRequest) {       // for Forefox, IE7+, Opera, Safari, ...
        xmlHttp = new XMLHttpRequest();
    }
    else if(window.ActiveXObject) {   // for Internet Explorer 5 or 6
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (xmlHttp == null) return;

    xmlHttp.onreadystatechange=function() {
        if (xmlHttp.readyState==4 && xmlHttp.status==200) {
            var info = xmlHttp.responseText;
            el.innerHTML = info;
        }
    }
    xmlHttp.open("POST", "http://localhost/Modal/test.php", true);
    xmlHttp.send(null);
}

function ajaxPostInfo(data) {
    var xmlHttp = null;

    if(window.XMLHttpRequest) {       // for Forefox, IE7+, Opera, Safari, ...
        xmlHttp = new XMLHttpRequest();
    }
    else if(window.ActiveXObject) {   // for Internet Explorer 5 or 6
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (xmlHttp == null) return;

    // post data
    var php_url = "http://localhost/Modal/test.php";

    xmlHttp.open("POST", php_url, true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send(data);

    // result
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            var result = xmlHttp.responseText;
            alert("Submit OK!\n" + result);
        }
    }
}