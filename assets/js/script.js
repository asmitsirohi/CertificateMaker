$(document).ready(() => {
    let alertTime = 3000;

    $('#certificateTemplate').on('change', function() {
        var filename = $(this).val();
        filename = filename.split('\\');
        $(this).next('.custom-file-label').html(filename[filename.length-1]);
        isFileSelected=true;
    });

    $('#signTemplate').on('change', function() {
        var filename = $(this).val();
        filename = filename.split('\\');
        $(this).next('.custom-file-label').html(filename[filename.length-1]);
        isFileSelected=true;
    });

    $('#uploadCertificate').submit((event) => {
        event.preventDefault();
        let certificateTemplate = $('#certificateTemplate').val();
        let userId = 2;

        if (certificateTemplate == '') {
            $('#warningAlert').css("display", "block");
            setTimeout(() => {
                $('#warningAlert').css("display", "none");
            }, alertTime);
            return false;
        } else {
            let extension = $('#certificateTemplate').val().split('.').pop().toLowerCase();

            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                $('#InvalidImageAlert').css("display", "block");
                setTimeout(() => {
                    $('#InvalidImageAlert').css("display", "none");
                }, alertTime);
                return false;
            } else {
                $('#templateBtn').css('display', 'none');
                $('#templateSpinner').css('display', 'block');
                let formData = new FormData()
                var d = $('#certificateTemplate')[0].files[0];
                formData.append('doc', d);
                formData.append('documentId', userId);
                $.ajax({
                    url: "partials/action.php",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        let obj = JSON.parse(data);
                        if (data) {
                            $('#successAlert').css("display", "block");
                            $("#userTemplate").attr({
                                "src": `partials/${obj.template}`
                            });
                            $("#savePDF").attr({
                                "href": `partials/${obj.template_pdf}`
                            });
                        
                            $('#templateImage').css("display", "block");
                            setTimeout(() => {
                                $('#successAlert').css("display", "none");
                            }, alertTime);
                        } else {
                            $('#warningAlert').css("display", "block");
                            setTimeout(() => {
                                $('#warningAlert').css("display", "none");
                            }, alertTime);
                        }
                        $('#templateSpinner').css('display', 'none');
                        $('#templateBtn').css('display', 'block');
                    }
                });

                // $('#v_documentForm')[0].reset();
            }
        }
    });

    $('#participantSave').click(() => {
        let participantName = $('#participantName').val();
        let participant_fontsize = $('#participant_fontsize').val();
        let participant_x_axis = $('#participant_x_axis').val();
        let participant_y_axis = $('#participant_y_axis').val();
        let participantSave = true;

        if (participantName != '' && participant_fontsize != '' && participant_x_axis != '' &&
            participant_y_axis != '') {
            $('#participantSave').css('display', 'none');
            $('#participantSpinner').css('display', 'block');
            $.post('partials/action.php', {
                participantSave: participantSave,
                participantName: participantName,
                participant_fontsize: participant_fontsize,
                participant_x_axis: participant_x_axis,
                participant_y_axis: participant_y_axis,

            }, function (response) {
                if (response) {
                    console.log(response);
                    $('#TemplateModifyAlert').css("display", "block");
                    $("#userTemplate").attr({
                        "src": `partials/${response}?v=${new Date().getTime()}`
                    });
                    $("#saveLocally").attr({
                        "href": `partials/${response}?v=${new Date().getTime()}`
                    });
                    setTimeout(() => {
                        $('#TemplateModifyAlert').css("display", "none");
                    }, alertTime);
                    $('#participantSpinner').css('display', 'none');
                    $('#participantSave').css('display', 'block');
                }
            });
        }

    });

    $('#eventSave').click(() => {
        let event_fontsize = $('#event_fontsize').val();
        let eventName = $('#eventName').val();
        let event_x_axis = $('#event_x_axis').val();
        let event_y_axis = $('#event_y_axis').val();
        let eventSave = true;

        if (eventName != '' && event_fontsize != '' && event_x_axis != '' &&
            event_y_axis != '') {
            $('#eventSave').css('display', 'none');
            $('#eventSpinner').css('display', 'block');
            $.post('partials/action.php', {
                eventSave: eventSave,
                eventName: eventName,
                event_fontsize: event_fontsize,
                event_x_axis: event_x_axis,
                event_y_axis: event_y_axis,

            }, function (response) {
                if (response) {
                    $('#TemplateModifyAlert').css("display", "block");
                    $("#userTemplate").attr({
                        "src": `partials/${response}?v=${new Date().getTime()}`
                    });
                    $("#saveLocally").attr({
                        "href": `partials/${response}?v=${new Date().getTime()}`
                    });
                    setTimeout(() => {
                        $('#TemplateModifyAlert').css("display", "none");
                    }, alertTime);
                    $('#eventSpinner').css('display', 'none');
                    $('#eventSave').css('display', 'block');
                }
            });
        }

    });

    $('#resultSave').click(() => {
        let result_fontsize = $('#result_fontsize').val();
        let resultName = $('#resultName').val();
        let result_x_axis = $('#result_x_axis').val();
        let result_y_axis = $('#result_y_axis').val();
        let resultSave = true;

        if (resultName != '' && result_fontsize != '' && result_x_axis != '' &&
            result_y_axis != '') {
            $('#resultSave').css('display', 'none');
            $('#resultSpinner').css('display', 'block');
            $.post('partials/action.php', {
                resultSave: resultSave,
                resultName: resultName,
                result_fontsize: result_fontsize,
                result_x_axis: result_x_axis,
                result_y_axis: result_y_axis,

            }, function (response) {
                if (response) {
                    $('#TemplateModifyAlert').css("display", "block");
                    $("#userTemplate").attr({
                        "src": `partials/${response}?v=${new Date().getTime()}`
                    });
                    $("#saveLocally").attr({
                        "href": `partials/${response}?v=${new Date().getTime()}`
                    });
                    setTimeout(() => {
                        $('#TemplateModifyAlert').css("display", "none");
                    }, alertTime);
                    $('#resultSpinner').css('display', 'none');
                    $('#resultSave').css('display', 'block');
                }
            });
        }

    });

    $('#descriptionSave').click(() => {
        let description_fontsize = $('#description_fontsize').val();
        let descriptionName = $('#descriptionName').val();
        let description_x_axis = $('#description_x_axis').val();
        let description_y_axis = $('#description_y_axis').val();
        let descriptionSave = true;

        if (descriptionName != '' && description_fontsize != '' && description_x_axis != '' &&
            description_y_axis != '') {
            $('#descriptionSave').css('display', 'none');
            $('#descriptionSpinner').css('display', 'block');
            $.post('partials/action.php', {
                descriptionSave: descriptionSave,
                descriptionName: descriptionName,
                description_fontsize: description_fontsize,
                description_x_axis: description_x_axis,
                description_y_axis: description_y_axis,

            }, function (response) {
                if (response) {
                    $('#TemplateModifyAlert').css("display", "block");
                    $("#userTemplate").attr({
                        "src": `partials/${response}?v=${new Date().getTime()}`
                    });
                    $("#saveLocally").attr({
                        "href": `partials/${response}?v=${new Date().getTime()}`
                    });
                    setTimeout(() => {
                        $('#TemplateModifyAlert').css("display", "none");
                    }, alertTime);
                    $('#descriptionSpinner').css('display', 'none');
                    $('#descriptionSave').css('display', 'block');
                }
            });
        }

    });

    $("#datePicker").datepicker({
        dateFormat: "dd/mm/yy",
        maxDate: "0",
        changeMonth: true,
        changeYear: true,
    });

    $('#dateSave').click(() => {
        let date_fontsize = $('#date_fontsize').val();
        let dateName = $('#datePicker').val();
        let date_x_axis = $('#date_x_axis').val();
        let date_y_axis = $('#date_y_axis').val();
        let dateSave = true;

        if (dateName != '' && date_fontsize != '' && date_x_axis != '' &&
            date_y_axis != '') {
            $('#dateSave').css('display', 'none');
            $('#dateSpinner').css('display', 'block');
            $.post('partials/action.php', {
                dateSave: dateSave,
                dateName: dateName,
                date_fontsize: date_fontsize,
                date_x_axis: date_x_axis,
                date_y_axis: date_y_axis,

            }, function (response) {
                if (response) {
                    $('#TemplateModifyAlert').css("display", "block");
                    $("#userTemplate").attr({
                        "src": `partials/${response}?v=${new Date().getTime()}`
                    });
                    $("#saveLocally").attr({
                        "href": `partials/${response}?v=${new Date().getTime()}`
                    });
                    setTimeout(() => {
                        $('#TemplateModifyAlert').css("display", "none");
                    }, alertTime);
                    $('#dateSpinner').css('display', 'none');
                    $('#dateSave').css('display', 'block');
                }
            });
        }

    });

    $('#organiserSave').click(() => {
        let organiser_fontsize = $('#organiser_fontsize').val();
        let organiserName = $('#organiserName').val();
        let organiser_x_axis = $('#organiser_x_axis').val();
        let organiser_y_axis = $('#organiser_y_axis').val();
        let organiserSave = true;

        if (organiserName != '' && organiser_fontsize != '' && organiser_x_axis != '' &&
            organiser_y_axis != '') {
            $('#organiserSave').css('display', 'none');
            $('#organiserSpinner').css('display', 'block');
            $.post('partials/action.php', {
                organiserSave: organiserSave,
                organiserName: organiserName,
                organiser_fontsize: organiser_fontsize,
                organiser_x_axis: organiser_x_axis,
                organiser_y_axis: organiser_y_axis,

            }, function (response) {
                if (response) {
                    $('#TemplateModifyAlert').css("display", "block");
                    $("#userTemplate").attr({
                        "src": `partials/${response}?v=${new Date().getTime()}`
                    });
                    $("#saveLocally").attr({
                        "href": `partials/${response}?v=${new Date().getTime()}`
                    });
                    setTimeout(() => {
                        $('#TemplateModifyAlert').css("display", "none");
                    }, alertTime);
                    $('#organiserSpinner').css('display', 'none');
                    $('#organiserSave').css('display', 'block');
                }
            });
        }

    });

    $('#uploadSign').submit((event) => {
        event.preventDefault();
        let signTemplate = $('#signTemplate').val();
        let userId = 2;

        if (signTemplate == '') {
            $('#warningAlert').css("display", "block");
            setTimeout(() => {
                $('#warningAlert').css("display", "none");
            }, alertTime);
            return false;
        } else {
            let extension = $('#signTemplate').val().split('.').pop().toLowerCase();

            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                $('#InvalidImageAlert').css("display", "block");
                setTimeout(() => {
                    $('#InvalidImageAlert').css("display", "none");
                }, alertTime);
                return false;
            } else {
                $('#signBtn').css('display', 'none');
                $('#signSpinner').css('display', 'block');
                let formData = new FormData()
                var d = $('#signTemplate')[0].files[0];
                formData.append('doc', d);
                formData.append('signId', userId);
                $.ajax({
                    url: "partials/action.php",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data) {
                            $('#successAlert').css("display", "block");
                            // $("#userTemplate").attr({
                            //     "src": `partials/${data}`
                            // });
                            // $('#templateImage').css("display", "block");
                            setTimeout(() => {
                                $('#successAlert').css("display", "none");
                            }, alertTime);
                        } else {
                            $('#warningAlert').css("display", "block");
                            setTimeout(() => {
                                $('#warningAlert').css("display", "none");
                            }, alertTime);
                        }
                        $('#signSpinner').css('display', 'none');
                        $('#signBtn').css('display', 'block');
                    }
                });

                // $('#v_documentForm')[0].reset();
            }
        }
    });

    $('#signPosSave').click(() => {
        let signPos_x_axis = $('#signPos_x_axis').val();
        let signPos_y_axis = $('#signPos_y_axis').val();
        let signPosSave = true;

        if (signPos_x_axis != '' && signPos_y_axis != '') {
            $('#signPosSave').css('display', 'none');
            $('#signPosSpinner').css('display', 'block');
            $.post('partials/action.php', {
                signPosSave: signPosSave,
                signPos_x_axis: signPos_x_axis,
                signPos_y_axis: signPos_y_axis,

            }, function (response) {
                if (response) {
                    $('#TemplateModifyAlert').css("display", "block");
                    $("#userTemplate").attr({
                        "src": `partials/${response}?v=${new Date().getTime()}`
                    });
                    $("#saveLocally").attr({
                        "href": `partials/${response}?v=${new Date().getTime()}`
                    });
                    setTimeout(() => {
                        $('#TemplateModifyAlert').css("display", "none");
                    }, alertTime);
                    $('#signPosSpinner').css('display', 'none');
                    $('#signPosSave').css('display', 'block');
                }
            });
        }

    });

    $('#sendMail').click(() => {
        $('#sendMail').css('display', 'none');
        $('#mailSpinner').css('display', 'block');

        let recieverEmail = $('#recieverEmail').val();
        let recieverSubject = $('#recieverSubject').val();
        let recieverBody = $('#recieverBody').val();

        if ($('#recieverImage').is(":checked")) {
            recieverImage = 'imageSet';
        } else {
            recieverImage = 'error';
        }

        if ($('#recieverPDF').is(":checked")) {
            recieverPDF = 'pdfSet';
        } else {
            recieverPDF = 'error';
        }

        if(recieverEmail != '') {
            $.post('partials/action.php', {
                recieverEmail : recieverEmail,
                recieverSubject : recieverSubject,
                recieverBody : recieverBody,
                recieverImage : recieverImage,
                recieverPDF : recieverPDF,
            }, function(response) {
                if(response != -1) {
                    $('#mailSpinner').css('display', 'none');
                    $('#sendMail').css('display', 'block');
                    $('#mailSendAlert').css('display', 'block');
    
                    setTimeout(() => {
                        $('#mailSendAlert').css("display", "none");
                    }, alertTime);
                } else {
                    $('#mailSpinner').css('display', 'none');
                    $('#sendMail').css('display', 'block');
                    $('#mailErrorAlert').css('display', 'block');
    
                    setTimeout(() => {
                        $('#mailErrorAlert').css("display", "none");
                    }, alertTime);
                }
            });
        }
    });
});