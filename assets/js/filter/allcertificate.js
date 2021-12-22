
$(document).ready(function () {
    $('#certclass').on('change', () => {
        var dropVal = $('#certclass').val();
        if (dropVal != 'false') {
            fetch_certificate(dropVal);
        }
    });

    function fetch_certificate(dataVal) {
        $.ajax({
            url: 'operation/fetch-certificate.php',
            data: { 'class': dataVal, 'api' : 'ss123' },
            type: 'post',
            dataType: 'JSON',

            success: function (data, status) {
                if (status) {
                    $('#certinfo').html('');


                    $.each(data, function (key, val) {
                        if (val.status == 1) {
                            var stat = "<button class = 'btn btn-info px-3' type = 'button'> Active </button>";
                        }else if (val.status == 0) {
                            var stat = "<button class = 'btn btn-warning' type = 'button'>Disable</button>";
                        }

                        if (val.Name == false) {
                            // console.log('falsse');
                            $('#certinfo').append(` <tr><td></td> <td></td><td>No</td> <td>Record</td> <td></td> <td>Found</td><td></td></tr>`);
                        }else{
                            $('#certinfo').append(` <tr>
                                                <td>${val.sn}</td>
                                                <td>${val.Name}</td>
                                                <td>${val.Class}</td>
                                                <td>${val.Roll}</td>
                                                <td>${val.Certificate}</td>
                                                <td>${stat}</td>
                                                <td><a href='certificate_edit.php?query_roll=${val.Roll}&class=${val.Class}'><span class='btn btn-primary'>Edit</span></a></td>
                             </tr>`);
                            }
                        

                    });

                }
            }
        });
    }

});
