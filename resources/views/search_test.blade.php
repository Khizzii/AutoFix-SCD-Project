<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Test</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background: #111; color: white; padding: 20px; font-family: sans-serif; }
        #results { margin-top: 10px; border: 1px solid #444; padding: 10px; }
        .item { padding: 5px; border-bottom: 1px solid #333; }
    </style>
</head>
<body>
    <h1>Search Test Page</h1>
    <input type="text" id="term" placeholder="Type to search..." style="padding: 10px; width: 300px;">
    <div id="results">Results will appear here...</div>

    <script>
        $(document).ready(function() {
            $('#term').on('keyup', function() {
                let query = $(this).val();
                console.log("Searching for:", query);

                $.ajax({
                    url: '/products/search',
                    type: 'GET',
                    data: { query: query },
                    success: function(response) {
                        console.log("Success:", response);
                        let html = '';
                        if(response.length > 0) {
                            response.forEach(p => {
                                html += `<div class="item"><strong>${p.name}</strong> - Rs ${p.price}</div>`;
                            });
                        } else {
                            html = 'No results found.';
                        }
                        $('#results').html(html);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        $('#results').html('<span style="color:red">Error: ' + error + '</span>');
                    }
                });
            });
        });
    </script>
</body>
</html>
