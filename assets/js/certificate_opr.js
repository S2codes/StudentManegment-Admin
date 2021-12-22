
// classlist
// studentlist
$(document).ready(function() {
    $('#classlist').on('change', function() {
        var dvlaue = $('#classlist').val(); 
        fetch_class(dvlaue);
    });

    function fetch_class(dataVal) {
        $.ajax({
            url: 'operation/fetch-allstudent.php',
            data: {
                'class': dataVal, 'api' : 'ss123'
            },
            type: 'post',
            dataType: 'JSON',

            success: function(data, status) {
                
                if (status) {
                    $('#studentlist').html('');
                    $('#studentlist').html(`<option value="false" selected>Select Student Name</option>`).css("color" , "#607080");
                    $.each(data, function(key, val) {
                        if (val.Name == false) {
                            $('#studentlist').html('');
                            $('#studentlist').html(`<option value="false">No student found! Please add student first</option>`).css("color" , "red");
                        }else{
                            $('#studentlist').append(`<option value="${val.Name}">${val.Name}</option>`).css("color" , "#607080");
                        }
                    });

                }
            }
        });
    }

    $('#studentlist').on('change', function() {
       console.log('hello');
        var className = $('#classlist').val();
        var stdName = $('#studentlist').val(); 
        console.log(stdName);
        if (stdName == "false") {
            $('#stdroll').val('Please Select Student Name');
        }else{
            fetch_allroll(stdName, className);
        }
    });

    function fetch_allroll(student, clss) {
        console.log('ddd');
        $.ajax({
            url: 'operation/fetch-allroll.php',
            data: { 'std': student, 'cls': clss, 'api': 'ss123' },
            type: 'post',
            dataType: 'JSON',

            success: function(data, status) {
                if (status) {
                    $('#stdroll').val(data);
                }
            }
        });
    }

});