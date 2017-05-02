
var progressCurrent = 0;
var isVoiceActivated = false;

$(document).ready(function(){
    $.scrollify({
        section: 'section.page',
        sectionName: 'section-name',
        after: launchAudio,
        before: manageProgressBar,
        afterRender: function(){
            manageProgressBar($.scrollify.current(), $('section.page'));
        }
    });
    
    $('#form').submit(function(){
        $('#btn-submit i.fa').removeClass().addClass('fa fa-cog fa-spin fa-fw');
        $.post('register.php', $(this).serialize()).done(function(){
            $('#btn-submit i.fa').removeClass().addClass('fa fa-check');    
        });
        return false;
    })
    
    $('a.next').on('click', function(){
        $.scrollify.next();
    });
    
    $('div.column').click(function(){
        var answer = $('input', $(this)).val().replace('<br>', '');
        $('input.answer', $($.scrollify.current())).val(answer);
        $('div.column', $($.scrollify.current())).removeClass('selected');
        $(this).addClass('selected');
        window.setTimeout(function(){
            $.scrollify.next();
        }, 400);
        
    });
    
    $(window).keypress(function(e){
        var answers = $('div.column', $($.scrollify.current())).map(function(){
            return $(this).data('key-code');
        }).get();
        
        if(answers.indexOf(e.keyCode) !== -1){
            
            $('div.column[data-key-code="'+e.keyCode+'"]', $($.scrollify.current())).trigger('click');
        }
    });
    
    $('#btn-voice').click(function(){
        console.log($(this), isVoiceActivated);
        if(isVoiceActivated){
            isVoiceActivated = false;
            $('#btn-voice span').html('Activer la voix');
            $('#btn-voice i.fa').removeClass('fa-volume-off').addClass('fa-volume-up');
            responsiveVoice.speak("Aurevoir !", 'French Female', {rate: 0.8});
        } else {
            isVoiceActivated = true;
            $('#btn-voice span').html('Désactiver la voix');
            $('#btn-voice i.fa').removeClass('fa-volume-up').addClass('fa-volume-off');
            responsiveVoice.speak("Bonjour !", 'French Female', {rate: 0.8});
        }
    });
});


function manageProgressBar(index, sections){
    if(typeof index == "undefined") index = 0;
    if(typeof sections == "undefined") sections = $('section.page').length;
    
    var rate = 0;
    
    if(index != 0){
        progressCurrent = index + 1;
        rate = (progressCurrent / sections.length) * 100;
    }
        
    $('div#progress-bar-state').css('width', rate + '%');
}

function launchAudio(index, sections){
    if(isVoiceActivated) readWithVoice($(sections[index]).attr('id'));
}

function readWithVoice(sectionId){
    var textToRead = $('#'+sectionId + ' .text-to-speach').text();
    responsiveVoice.speak(textToRead, 'French Female', {rate: 0.8});
}