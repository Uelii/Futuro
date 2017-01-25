function showJobsOnDropdownChange() {
    $(document).ready(function() {
        $('#lid').change(function() {
            var id = $("#lid").val();
            var url = '../scripts/showJobsQuery.php';
            var trData = '';

            //Delete existing rows in prior to ajax function
            $('#liar tr').has('td').remove();

            if(id != ''){
                $.ajax({
                    url: url+'/'+id,
                    type: 'GET',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data)
                    {
                        $.each(data, function() {
                            $.each($(this), function(key, val) {
                                trData +=
                                    '<tr><td>' + val.datum +
                                    '</td><td>' + val.person_list.replace(/,/g, '<br>') +
                                    '</td><td>' + val.arbeit_list.replace(/,/g, '<br>') +
                                    '</td><td>' + val.zeit +
                                    '</td><td>' + val.kosten +
                                    '</td><td>' + val.material +
                                    '</td><td>' + val.zusaetzlicheArbeiten +
                                    '</td><td>' + val.bemerkung +
                                    '</td></tr>';
                            });
                        });
                        //Append rows to existing table
                        $('#liar').append(trData);
                    }
                });
            } else {
                //Whatever
            }
        });
    });
}