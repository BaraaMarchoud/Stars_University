$(document).ready(function() {
    $('#search').keyup(function() {
        var searchValue = $(this).val(); 
        if (searchValue === '') {
            $('#search_result').html(''); 
        } else {
            $.ajax({
                type: 'POST',
                url: 'search.php', 
                data: {search: searchValue},
                success: function(data) {
                    $('#search_result').html(data); 
                }
            });
        }
    });
});