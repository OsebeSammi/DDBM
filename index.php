<?php

    $configJson = file_get_contents("global_schema.json");
?>

<html>
<head>
    <script type="text/javascript" src="jquery.js"></script>
    <script>
        var configJson = <?php echo $configJson?>;

        function sendAjax(url,sql)
        {
            $.ajax
            ({
                url: url,
                data: {
                    sql: sql
                },
                type: "POST",

                dataType : "text",

                success: function( text )
                {
                    $("#result").html(text);
                },

                error: function( xhr, status, errorThrown ) {
                    alert( "Sorry, there was a problem!" );
                    console.log( "Error: " + errorThrown );
                    console.log( "Status: " + status );
                    console.dir( xhr );
                },

                complete: function( xhr, status )
                {

                }
            });
        }
    </script>
</head>
<body>
<h1>MiddleWare</h1>
    <textarea name="query" style="width:100%;padding: 3%;"></textarea>
    <button onclick="getQuery()">query</button>
    <script>
        function getQuery()
        {
            var valueTA = $("textarea[name=query]").val();
            var fromIndex = valueTA.indexOf("FROM");
            var whereIndex = valueTA.indexOf("WHERE");

            var tableName = null;
            if(whereIndex == -1)
            {
                tableName = valueTA.substring(fromIndex+5,valueTA.length-1);
            }
            else
            {
                tableName = valueTA.substring(fromIndex+5,whereIndex);
            }

            tableName = tableName.trim();

            var link = [];
            //looping through globla schema
            $.each(configJson.tables,function(t,obj)
            {
                if(t == tableName)
                {
                   var count = 0;
                    $.each(obj.fragments,function(i,tab)
                    {
                        link[count] = i;
                        count++;
                    });
                }
            });

            $.each(configJson.sites,function(i,aSite)
            {
                if($.inArray(i,link))
                {
                    alert();
                }
            });
        }
    </script>
    <div id="result"></div>
</body>
</html>