$( function() {

    $( "#stepsList" ).sortable();
    $( "#stepsList" ).disableSelection();
    } );

    let lineNo = 0;
    let stepId;
    


    $('.btn-add-step').on('click', function(StepId, lineNo) {

        StepId = Math.floor((Math.random() * 100000000000000000));

        let title = $('.input-add-step-title').val();
        let description = $('.input-add-step-description').val();
        let role = $('.input-add-step-role').val();
        lineNo++;
        
        let newStep = generateStep(StepId, title, description, role, lineNo);

        $('#stepsList').append(newStep);
    });

    $(".btn-add-step").click(".modal", function(){
        $(".input-add-step-title").val("");
        $(".input-add-step-description").val("");
        $(".input-add-step-role").val("");
    });

    /* !!NOT FINISHED, I WERE TESTING STUFF!!

    $(document).on('click', '.editStepButton', function () {
        let self = this;
        let title = $(self).parent().parent().find('.title').data('title');
        let description = $(self).parent().parent().find('.description').data('description');
        let role = $(self).parent().parent().find('.role').data('role');

        $('.input-edit-step-title').val(title);
        $('.input-edit-step-description').val(description);
        $('.input-edit-step-role').val(role);

        $('#stepsList').append(newStep);

        $('.btn-edit-step').on('click', function() {

            let newTitle = $('.input-edit-step-title').val();
            let newDescription = $('.input-edit-step-description').val();
            let newRole = $('.input-edit-step-role').val();
    
            document.getElementByClass('title').innerHTML = newTitle;
            document.getElementByClass('description').innerHTML = newDescription;
            document.getElementByClass('role').innerHTML = newRole;
            
        });
    });
    */ 
    

    function generateStep(StepId, title, description, role, lineNo) {
        return `<tr id="stepId-${StepId}">
                    <td class="align-middle title word-break" data-title="${title}">${title}</td>
                    <td class="align-middle description word-break" data-description="${description}">${description}</td>
                    <td class="align-middle role word-break" data-role="${role}">${role}</td>
                    <td>
                        <a class="align-middle btn btn-warning editStepButton mb-1 mt-1" data-toggle="modal" data-target="#editStepModal"><i class="fas fa-pen"></i></a>
                        <a data-toggle="modal" class="align-middle btn btn-danger  mb-1 mt-1 deleteStepButton" data-toggle="modal" data-target="#removeStepModal"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    <td><i class="align-middle fas fa-arrows-alt-v" data-toggle="tooltip" title="Drag to change the order"></i></td>
                </tr>`
    };