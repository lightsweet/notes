
function show(el, disp) {
    $('#' + el).css('display', disp);
}

function hide(el) {
    $('#' + el).css('display', 'none');
}

function checkPswds(){
    if($('#pswd-reg').val() != $('#pswd-reg1').val()){
        show('reg-info', 'block');
        $('#reg-info').html('Пароли не совпадают.');
    }
    else {
        $('#reg-info').html('');
    }
}

function noteToEdit(id){
    hide('content_' + id);
    show('editcontent_' + id, 'block');
    hide('title_' + id);
    show('edittitle_' + id, 'block');
    hide('edit0-btn-' + id);
    show('edit-btn-' + id, 'block');
}

function noteFromEdit(id){
    hide('editcontent_' + id);
    show('content_' + id, 'block');
    hide('edittitle_' + id);
    show('title_' + id, 'block');
    hide('edit-btn-' + id);
    show('edit0-btn-' + id, 'block');
}

